<?php

namespace Tests\Feature;

use App\Models\Ingresso;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        $admin = User::factory()->create([
            'email' => 'admin@copa2026.com',
        ]);
        $admin->is_admin = true;
        $admin->save();

        return $admin;
    }

    private function createUser(): User
    {
        return User::factory()->create([
            'email' => 'user@copa2026.com',
        ]);
    }

    // --- Guest access ---

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_guest_cannot_access_admin_ingressos(): void
    {
        $this->get('/admin/ingressos')->assertRedirect('/login');
    }

    public function test_guest_cannot_create_ingresso(): void
    {
        $this->post('/admin/ingressos', [
            'jogo' => 'Brasil vs Argentina',
            'setor' => 'Norte',
            'preco' => 500,
            'quantidade' => 100,
        ])->assertRedirect('/login');
    }

    // --- Regular user access (deve ser bloqueado) ---

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $this->actingAs($this->createUser());

        $this->get('/admin')->assertStatus(403);
    }

    public function test_regular_user_cannot_access_admin_ingressos(): void
    {
        $this->actingAs($this->createUser());

        $this->get('/admin/ingressos')->assertStatus(403);
    }

    public function test_regular_user_cannot_create_ingresso(): void
    {
        $this->actingAs($this->createUser());

        $this->post('/admin/ingressos', [
            'jogo' => 'Brasil vs Argentina',
            'setor' => 'Norte',
            'preco' => 500,
            'quantidade' => 100,
        ])->assertStatus(403);
    }

    public function test_regular_user_cannot_edit_ingresso(): void
    {
        $this->actingAs($this->createUser());
        $ingresso = Ingresso::factory()->create();

        $this->get("/admin/ingressos/{$ingresso->id}/editar")->assertStatus(403);
    }

    public function test_regular_user_cannot_delete_ingresso(): void
    {
        $this->actingAs($this->createUser());
        $ingresso = Ingresso::factory()->create();

        $this->delete("/admin/ingressos/{$ingresso->id}")->assertStatus(403);
    }

    public function test_regular_user_cannot_view_admin_pedidos(): void
    {
        $this->actingAs($this->createUser());

        $this->get('/admin/pedidos')->assertStatus(403);
    }

    // --- Admin access (deve funcionar) ---

    public function test_admin_can_access_dashboard(): void
    {
        $this->actingAs($this->createAdmin());

        $this->get('/admin')->assertStatus(200);
    }

    public function test_admin_can_access_ingressos_index(): void
    {
        $this->actingAs($this->createAdmin());

        $this->get('/admin/ingressos')->assertStatus(200);
    }

    public function test_admin_can_create_ingresso(): void
    {
        $this->actingAs($this->createAdmin());

        $this->post('/admin/ingressos', [
            'jogo' => 'Brasil vs Argentina',
            'setor' => 'Norte',
            'preco' => 500,
            'quantidade' => 100,
        ])->assertRedirect(route('admin.ingressos.index'));

        $this->assertDatabaseHas('ingressos', [
            'jogo' => 'Brasil vs Argentina',
            'setor' => 'Norte',
        ]);
    }

    public function test_admin_can_edit_ingresso(): void
    {
        $this->actingAs($this->createAdmin());
        $ingresso = Ingresso::factory()->create();

        $this->get("/admin/ingressos/{$ingresso->id}/editar")->assertStatus(200);
    }

    public function test_admin_can_update_ingresso(): void
    {
        $this->actingAs($this->createAdmin());
        $ingresso = Ingresso::factory()->create();

        $this->put("/admin/ingressos/{$ingresso->id}", [
            'jogo' => 'Final Copa 2026',
            'setor' => 'VIP',
            'preco' => 2500,
            'quantidade' => 50,
        ])->assertRedirect(route('admin.ingressos.index'));

        $ingresso->refresh();
        $this->assertEquals('Final Copa 2026', $ingresso->jogo);
    }

    public function test_admin_can_delete_ingresso(): void
    {
        $this->actingAs($this->createAdmin());
        $ingresso = Ingresso::factory()->create();

        $this->delete("/admin/ingressos/{$ingresso->id}")->assertRedirect(route('admin.ingressos.index'));

        $this->assertDatabaseMissing('ingressos', ['id' => $ingresso->id]);
    }

    public function test_admin_can_view_pedidos(): void
    {
        $this->actingAs($this->createAdmin());

        $this->get('/admin/pedidos')->assertStatus(200);
    }

    // --- Mass assignment protection ---

    public function test_registration_cannot_set_is_admin(): void
    {
        $this->post('/register', [
            'name' => 'Hacker',
            'email' => 'hacker@example.com',
            'password' => 'Hacker123',
            'password_confirmation' => 'Hacker123',
            'is_admin' => 1,
        ]);

        $user = User::where('email', 'hacker@example.com')->first();
        $this->assertFalse($user->is_admin);
    }
}
