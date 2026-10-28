<?php

namespace Feature\WEB;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    // тест users.index
    public function test_unauthorized_user_index_list(): void
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_index_list_forbidden(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get(route('users.index'));
        $response->assertStatus(403);
    }

    public function test_admin_index_list(): void
    {
        $factoryUser = User::factory()->create(['role' => 'admin']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($user)->get(route('users.index'));
        $response->assertStatus(200);
    }

    // тест users.create
    public function test_unauthorized_user_create(): void
    {
        $response = $this->get(route('users.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_create_forbidden(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get(route('users.create'));
        $response->assertStatus(403);
    }

    public function test_admin_user_create(): void
    {
        $factoryUser = User::factory()->create(['role' => 'admin']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($user)->get(route('users.create'));
        $response->assertStatus(200);
    }

    // тест users.store
    public function test_unauthorized_user_store(): void
    {
        $response = $this->get(route('users.store'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_store_forbidden(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get(route('users.store'));
        $response->assertStatus(403);
    }

    public function test_admin_user_store(): void
    {
        $factoryUser = User::factory()->create(['role' => 'admin']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($user)->get(route('users.store'));
        $response->assertStatus(200);
    }

    // тест users.edit
    public function test_unauthorized_user_edit(): void
    {
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->get(route('users.edit', $user));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_edit_forbidden(): void
    {
        $user1 = User::factory()->create(['role' => 'user']);
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user2 = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($user1)->get(route('users.edit', $user2));
        $response->assertStatus(403);
    }

    public function test_admin_user_edit(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($admin)->get(route('users.edit', $user));
        $response->assertStatus(200);
    }

    // тест users.update
    public function test_unauthorized_user_update(): void
    {
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->put(route('users.update', $user), $this->userUpdatePayload());
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_update_forbidden(): void
    {
        $user1 = User::factory()->create(['role' => 'user']);
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user2 = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($user1)->put(route('users.update', $user2), $this->userUpdatePayload());
        $response->assertStatus(403);
    }

    public function test_admin_user_update(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $payload = $this->userUpdatePayload();
        $response = $this->actingAs($admin)->put(route('users.update', $user), $payload);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $payload['name'],
            'email' => $payload['email'],
            'status' => $payload['status'],
        ]);
    }

    // тест users.destroy
    public function test_unauthorized_user_destroy(): void
    {
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->delete(route('users.destroy', $user));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        $this->assertNotNull($user->fresh());
    }

    public function test_non_admin_user_destroy_forbidden(): void
    {
        $user1 = User::factory()->create(['role' => 'user']);
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user2 = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($user1)->delete(route('users.destroy', $user2));
        $response->assertStatus(403);
        $this->assertNotNull($user2->fresh());
    }

    public function test_admin_user_destroy(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $factoryUser = User::factory()->create(['role' => 'user']);
        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();
        $response = $this->actingAs($admin)->delete(route('users.destroy', $user));
        $response->assertStatus(302);
        $response->assertRedirect(route('users.index'));
        $this->assertNull($user->fresh());
    }

    //приватный хелпер по рекомендациям
    /**
     * @return array<string, string>
     */
    private function userUpdatePayload(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'user',
            'status' => 'active',
            'phone' => fake()->phoneNumber(),
            'position' => fake()->jobTitle(),
            'notes' => fake()->sentence(),
        ];
    }
}
