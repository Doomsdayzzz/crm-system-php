<?php

namespace Tests\WEB;

use App\Enums\ApplicationStatusEnum;
use App\Models\Application;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use DatabaseTransactions;

    private function createAdmin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function createUser(): User
    {
        return User::factory()->create(['role' => 'user']);
    }

    private function createDepartment(): Department
    {
        return Department::query()->first()
            ?? Department::create(['title' => 'Отдел для тестов']);
    }

    private function validPayload(Department $department): array
    {
        return [
            'title' => 'Тестовая заявка',
            'description' => 'Описание тестовой заявки',
            'department_id' => $department->id,
            'user_id' => null,
            'status' => ApplicationStatusEnum::NEW->value,
        ];
    }

    public function test_index_access(): void
    {
        $this->get(route('applications.index'))->assertRedirect(route('login'));

        $this->actingAs($this->createUser())
            ->get(route('applications.index'))
            ->assertStatus(403);

        $this->actingAs($this->createAdmin())
            ->get(route('applications.index'))
            ->assertOk()
            ->assertSee('Создать заявку')
            ->assertSee('Статусы:');
    }

    public function test_create_access(): void
    {
        $this->get(route('applications.create'))->assertRedirect(route('login'));

        $this->actingAs($this->createUser())
            ->get(route('applications.create'))
            ->assertStatus(403);

        $this->actingAs($this->createAdmin())
            ->get(route('applications.create'))
            ->assertOk()
            ->assertSee('Создание заявки')
            ->assertSee('Ответственный');
    }

    public function test_show_access(): void
    {
        $application = Application::factory()->create();

        $this->get(route('applications.show', $application))->assertRedirect(route('login'));

        $this->actingAs($this->createUser())
            ->get(route('applications.show', $application))
            ->assertStatus(403);

        $this->actingAs($this->createAdmin())
            ->get(route('applications.show', $application))
            ->assertOk()
            ->assertSee('Описание заявки')
            ->assertSee($application->title);
    }

    public function test_edit_access(): void
    {
        $application = Application::factory()->create();

        $this->get(route('applications.edit', $application))->assertRedirect(route('login'));

        $this->actingAs($this->createUser())
            ->get(route('applications.edit', $application))
            ->assertStatus(403);

        $this->actingAs($this->createAdmin())
            ->get(route('applications.edit', $application))
            ->assertOk()
            ->assertSee('Сохранить изменения')
            ->assertSee($application->title);
    }

    public function test_store(): void
    {
        $payload = $this->validPayload($this->createDepartment());

        $response = $this->actingAs($this->createAdmin())
            ->post(route('applications.store'), $payload);

        $response->assertStatus(302);
        $this->assertDatabaseHas('applications', [
            'title' => $payload['title'],
            'description' => $payload['description'],
            'department_id' => $payload['department_id'],
            'status' => $payload['status'],
        ]);

        $application = Application::query()->where('title', $payload['title'])->firstOrFail();
        $response->assertRedirect(route('applications.show', $application));
    }

    public function test_store_validation(): void
    {
        $response = $this->actingAs($this->createAdmin())
            ->post(route('applications.store'), [
                'title' => '',
                'department_id' => 0,
                'status' => 999,
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'department_id', 'status']);
    }

    public function test_store_forbidden(): void
    {
        $payload = $this->validPayload($this->createDepartment());

        $this->actingAs($this->createUser())
            ->post(route('applications.store'), $payload)
            ->assertStatus(403);

        $this->assertDatabaseMissing('applications', ['title' => $payload['title']]);
    }

    public function test_update(): void
    {
        $application = Application::factory()->create();
        $department = $this->createDepartment();

        $payload = [
            'title' => 'Обновленная заявка',
            'description' => 'Новое описание',
            'department_id' => $department->id,
            'user_id' => null,
            'status' => ApplicationStatusEnum::IN_PROGRESS->value,
        ];

        $response = $this->actingAs($this->createAdmin())
            ->put(route('applications.update', $application), $payload);

        $response->assertStatus(302);
        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'title' => 'Обновленная заявка',
            'status' => ApplicationStatusEnum::IN_PROGRESS->value,
        ]);
    }

    public function test_update_validation(): void
    {
        $application = Application::factory()->create();

        $response = $this->actingAs($this->createAdmin())
            ->put(route('applications.update', $application), [
                'title' => '',
                'department_id' => '',
                'status' => 999,
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'department_id', 'status']);
    }

    public function test_destroy(): void
    {
        $application = Application::factory()->create();
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->delete(route('applications.destroy', $application->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('applications.index'));
        $this->assertNull($application->fresh());
    }

    public function test_destroy_forbidden(): void
    {
        $application = Application::factory()->create();

        $this->actingAs($this->createUser())
            ->delete(route('applications.destroy', $application->id))
            ->assertStatus(403);

        $this->assertNotNull($application->fresh());
    }
}
