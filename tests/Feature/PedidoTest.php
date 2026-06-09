<?php

namespace Tests\Feature;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): User
    {
        return User::factory()->create(['is_admin' => false]);
    }

    private function createPedido(User $user, array $overrides = []): Pedido
    {
        return Pedido::create(array_merge([
            'user_id' => $user->id,
            'total' => 100,
            'status' => 'completed',
            'cliente_nome' => $user->name,
            'cliente_email' => $user->email,
        ], $overrides));
    }

    // --- Meus Pedidos ---

    public function test_meus_pedidos_exige_auth(): void
    {
        $this->get(route('pedidos.index'))
            ->assertRedirect(route('login'));
    }

    public function test_meus_pedidos_mostra_apenas_pedidos_do_usuario(): void
    {
        $user1 = $this->createUser();
        $user2 = User::factory()->create(['is_admin' => false]);

        $pedido1 = $this->createPedido($user1, ['total' => 100]);
        $pedido2 = $this->createPedido($user2, ['total' => 999]);

        $response = $this->actingAs($user1)->get(route('pedidos.index'));

        $response->assertOk();
        $pedidosView = $response->viewData('pedidos');
        $this->assertTrue($pedidosView->contains($pedido1->id));
        $this->assertFalse($pedidosView->contains($pedido2->id));
    }

    public function test_meus_pedidos_ordenados_por_mais_recente(): void
    {
        $user = $this->createUser();

        $pedidoAntigo = $this->createPedido($user, ['total' => 100]);
        // Force different timestamp
        $pedidoAntigo->created_at = now()->subDays(2);
        $pedidoAntigo->save();

        $pedidoNovo = $this->createPedido($user, ['total' => 200]);

        $response = $this->actingAs($user)->get(route('pedidos.index'));

        $pedidosView = $response->viewData('pedidos');
        $this->assertEquals($pedidoNovo->id, $pedidosView->first()->id);
        $this->assertEquals($pedidoAntigo->id, $pedidosView->last()->id);
    }

    // --- Detalhe do pedido ---

    public function test_detalhe_pedido_exige_auth(): void
    {
        $user = $this->createUser();
        $pedido = $this->createPedido($user);

        $this->get(route('pedidos.show', $pedido->id))
            ->assertRedirect(route('login'));
    }

    public function test_usuario_pode_ver_proprio_pedido(): void
    {
        $user = $this->createUser();
        $pedido = $this->createPedido($user, ['total' => 300]);

        $this->actingAs($user)
            ->get(route('pedidos.show', $pedido->id))
            ->assertOk();
    }

    public function test_usuario_nao_pode_ver_pedido_de_outro(): void
    {
        $user1 = $this->createUser();
        $user2 = User::factory()->create(['is_admin' => false]);

        $pedido = $this->createPedido($user2, ['total' => 300]);

        $this->actingAs($user1)
            ->get(route('pedidos.show', $pedido->id))
            ->assertForbidden();
    }

    public function test_pedido_404_quando_id_invalido(): void
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->get(route('pedidos.show', 999999))
            ->assertNotFound();
    }
}
