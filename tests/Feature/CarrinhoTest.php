<?php

namespace Tests\Feature;

use App\Models\Ingresso;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarrinhoTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): User
    {
        return User::factory()->create();
    }

    private function createIngresso(int $quantidade = 10): Ingresso
    {
        return Ingresso::factory()->create(['quantidade' => $quantidade]);
    }

    // --- Guest é redirecionado para login ---

    public function test_guest_cannot_add_to_cart(): void
    {
        $ingresso = $this->createIngresso();

        $this->post("/ingresso/{$ingresso->id}/carrinho")
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_remove_from_cart(): void
    {
        $ingresso = $this->createIngresso();

        $this->post("/carrinho/remover/{$ingresso->id}")
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_checkout(): void
    {
        $this->get('/carrinho/checkout')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_confirm_purchase(): void
    {
        $this->post('/carrinho/confirmar')
            ->assertRedirect('/login');
    }

    public function test_guest_can_view_cart_page(): void
    {
        $this->get('/carrinho')->assertStatus(200);
    }

    // --- User autenticado pode usar o carrinho ---

    public function test_authenticated_user_can_add_to_cart(): void
    {
        $user = $this->createUser();
        $ingresso = $this->createIngresso();

        $this->actingAs($user)
            ->post("/ingresso/{$ingresso->id}/carrinho")
            ->assertRedirect();

        $this->assertEquals(1, session('carrinho')[$ingresso->id]['quantidade']);
    }

    public function test_adding_sold_out_ingresso_shows_error(): void
    {
        $user = $this->createUser();
        $ingresso = $this->createIngresso(0);

        $this->actingAs($user)
            ->post("/ingresso/{$ingresso->id}/carrinho")
            ->assertRedirect()
            ->assertSessionHas('erro');
    }

    public function test_authenticated_user_can_remove_from_cart(): void
    {
        $user = $this->createUser();
        $ingresso = $this->createIngresso();

        session(['carrinho' => [
            $ingresso->id => [
                'preco' => $ingresso->preco,
                'quantidade' => 1,
            ],
        ]]);

        $this->actingAs($user)
            ->post("/carrinho/remover/{$ingresso->id}")
            ->assertRedirect();

        $this->assertEmpty(session('carrinho'));
    }

    public function test_authenticated_user_can_view_checkout(): void
    {
        $user = $this->createUser();
        $ingresso = $this->createIngresso();

        session(['carrinho' => [
            $ingresso->id => [
                'preco' => $ingresso->preco,
                'quantidade' => 1,
            ],
        ]]);

        $this->actingAs($user)
            ->get('/carrinho/checkout')
            ->assertStatus(200);
    }

    public function test_empty_cart_checkout_redirects(): void
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->get('/carrinho/checkout')
            ->assertRedirect()
            ->assertSessionHas('erro');
    }

    // --- Confirmação de compra ---

    public function test_authenticated_user_can_confirm_purchase(): void
    {
        $user = $this->createUser();
        $ingresso = $this->createIngresso(10);

        session(['carrinho' => [
            $ingresso->id => [
                'preco' => $ingresso->preco,
                'quantidade' => 2,
            ],
        ]]);

        $this->actingAs($user)
            ->post('/carrinho/confirmar')
            ->assertRedirect();

        $this->assertDatabaseHas('pedidos', [
            'user_id' => $user->id,
            'status' => 'completed',
            'total' => $ingresso->preco * 2,
        ]);

        $this->assertDatabaseHas('pedido_items', [
            'ingresso_id' => $ingresso->id,
            'quantidade' => 2,
            'preco_unitario' => $ingresso->preco,
        ]);

        $ingresso->refresh();
        $this->assertEquals(8, $ingresso->quantidade);
    }

    public function test_confirm_purchase_clears_cart(): void
    {
        $user = $this->createUser();
        $ingresso = $this->createIngresso(10);

        session(['carrinho' => [
            $ingresso->id => [
                'preco' => $ingresso->preco,
                'quantidade' => 1,
            ],
        ]]);

        $this->actingAs($user)
            ->post('/carrinho/confirmar');

        $this->assertNull(session('carrinho'));
    }

    public function test_confirm_purchase_fails_when_stock_depleted(): void
    {
        $user = $this->createUser();
        $ingresso = $this->createIngresso(1);

        session(['carrinho' => [
            $ingresso->id => [
                'preco' => $ingresso->preco,
                'quantidade' => 5,
            ],
        ]]);

        $this->actingAs($user)
            ->post('/carrinho/confirmar')
            ->assertRedirect()
            ->assertSessionHas('erro');

        $this->assertDatabaseCount('pedidos', 0);
    }

    public function test_empty_cart_confirm_redirects(): void
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->post('/carrinho/confirmar')
            ->assertRedirect()
            ->assertSessionHas('erro');
    }
}
