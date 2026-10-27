<?php

namespace Feature\WEB;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_remove(): void
    {
        $factoryUser = User::factory()->create();
        $admin = User::factory()->create(['role' => 'admin']);

        $user = User::query()
            ->where('id', $factoryUser->id)
            ->where('email', $factoryUser->email)
            ->first();

        $response = $this->actingAs($admin)->delete(route('users.destroy', $user->id));
        $response->assertStatus(302);
        $this->assertNull($user->fresh());
    }

}
