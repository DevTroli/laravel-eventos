<?php

namespace Tests\Feature;

use App\Models\Ingresso;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidoAccessTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): User
    {
        return User::factory()->create();
    }

    private function createPedido(User $user): Pedido
    {
        $ingresso = Ingresso::factory()->create(['quantidade' => 50]);

        $pedido = Pedido::create([
            'user_id' => $user->id,
            'total' => $ingresso->preco * 2,
            'status' => 'completed',
            'cliente_nome' => $user->name,
            'cliente_email' => $user->email,
        ]);

        PedidoItem::create([
            'pedido_id' => $pedido->id,
            'ingresso_id' => $ingresso->id,
            'quantidade' => 2,
            'preco_unitario' => $ingresso->preco,
        ]);

        return $pedido;
    }

    // --- Guest não pode ver pedidos ---

    public function test_guest_cannot_view_meus_pedidos(): void
    {
        $this->get('/meus-pedidos')->assertRedirect('/login');
    }

    public function test_guest_cannot_view_pedido_detail(): void
    {
        $user = $this->createUser();
        $pedido = $this->createPedido($user);

        $this->get("/meus-pedidos/{$pedido->id}")->assertRedirect('/login');
    }

    // --- User só pode ver seus próprios pedidos ---

    public function test_user_can_view_own_pedidos_list(): void
    {
        $user = $this->createUser();
        $this->createPedido($user);

        $this->actingAs($user)
            ->get('/meus-pedidos')
            ->assertStatus(200);
    }

    public function test_user_can_view_own_pedido_detail(): void
    {
        $user = $this->createUser();
        $pedido = $this->createPedido($user);

        $this->actingAs($user)
            ->get("/meus-pedidos/{$pedido->id}")
            ->assertStatus(200);
    }

    public function test_user_cannot_view_other_users_pedido(): void
    {
        $owner = $this->createUser();
        $pedido = $this->createPedido($owner);

        $otherUser = User::factory()->create();

        $this->actingAs($otherUser)
            ->get("/meus-pedidos/{$pedido->id}")
            ->assertStatus(403);
    }

    public function test_meus_pedidos_only_shows_own_orders(): void
    {
        $user1 = $this->createUser();
        $user2 = User::factory()->create();
        $this->createPedido($user1);
        $this->createPedido($user2);

        $response = $this->actingAs($user1)
            ->get('/meus-pedidos');

        $response->assertStatus(200);
        $pedidos = $response->viewData('pedidos');
        $this->assertCount(1, $pedidos);
        $this->assertEquals($user1->id, $pedidos->first()->user_id);
    }

    public function test_nonexistent_pedido_returns_404(): void
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->get('/meus-pedidos/999')
            ->assertStatus(404);
    }
}
