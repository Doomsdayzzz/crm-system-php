<?php

namespace Feature\WEB;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_page(): void
    {
        $this->get(route('login'))->assertStatus(200);
    }

    public function test_register_page(): void
    {
        $this->get(route('register'))->assertStatus(200);
    }

    public function test_login_validate()
    {
        $response = $this->post(route('login'), [
            'email' => 'qweqwe@mail.ru',
            'password' => 'qweqweqwe',
        ]);


        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);
        $this->assertFalse(Auth::check());
    }

    public function test_login(): void
    {
        $password = 'password';
        $user = User::factory([
            'password' => Hash::make($password),
        ])->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    public function test_register_validate(): void
    {
        $data = [
            'password' => 'passwor',
            'password_confirmation' => 'passwor',
            'email' => 'test.random' . Str::random(5) . 'mail.ru',
            'name' => null,
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(302);
        unset($data['password_confirmation']);
        $response->assertSessionHasErrors(array_keys($data));
        $response->assertSessionHasErrors([
            'name' => 'Поле пароль обязательна к заполнению!',
            'email' => 'The email field must be a valid email address.',
            'password' => 'The password field must be at least 8 characters.',
        ]);
    }

    public function test_register(): void
    {
        $data = [
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => 'test.random' . Str::random(5) . '@mail.ru',
            'name' => Str::random(10),
        ];

        $response = $this->post(route('register'), $data);
        $user = User::query()->where('email', $data['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals($user->email, $data['email']);
        $this->assertEquals($user->name, $data['name']);
        $this->assertTrue(Hash::check($data['password'], $user->password));

        $this->assertAuthenticated();
        $response->assertStatus(302);
    }

}
