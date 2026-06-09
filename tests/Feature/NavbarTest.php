<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_sees_login_and_register_links(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Entrar');
        $response->assertSee('Criar Conta');
        $response->assertDontSee('Admin');
        $response->assertDontSee('Sair');
    }

    public function test_regular_user_sees_meus_pedidos_not_admin(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee('Meus Pedidos');
        $response->assertDontSee('>Admin</a>');
        $response->assertSee('Sair');
    }

    public function test_admin_user_sees_admin_link(): void
    {
        $admin = User::factory()->create(['email' => 'admin@copa2026.com']);
        $admin->is_admin = true;
        $admin->save();

        $response = $this->actingAs($admin)->get('/');

        $response->assertStatus(200);
        $response->assertSee($admin->name);
        $response->assertSee('Admin');
    }

    public function test_user_name_displayed_instead_of_email(): void
    {
        $user = User::factory()->create([
            'name' => 'João Silva',
            'email' => 'joao@example.com',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertSee('João Silva');
    }

    public function test_dashboard_redirects_admin_to_admin_panel(): void
    {
        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_dashboard_redirects_regular_user_to_pedidos(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertRedirect(route('pedidos.index'));
    }
}
