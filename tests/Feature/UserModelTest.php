<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_admin_returns_true_for_admin(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($admin->isAdmin());
        $this->assertTrue($admin->is_admin);
    }

    public function test_is_admin_returns_false_for_regular_user(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($user->isAdmin());
    }

    public function test_is_admin_is_cast_to_boolean(): void
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $admin->refresh();

        $this->assertIsBool($admin->is_admin);
        $this->assertTrue($admin->is_admin);
    }

    public function test_is_admin_default_is_false(): void
    {
        $user = User::factory()->create();

        $this->assertFalse($user->is_admin);
    }

    public function test_registration_cannot_set_is_admin_via_form(): void
    {
        $response = $this->post('/register', [
            'name' => 'Hacker',
            'email' => 'hacker@test.com',
            'password' => 'Senha123',
            'password_confirmation' => 'Senha123',
            'is_admin' => true,
        ]);

        $user = User::where('email', 'hacker@test.com')->first();
        $this->assertFalse($user->isAdmin());
    }
}
