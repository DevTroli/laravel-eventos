<?php

namespace Tests\Feature;

use App\Models\Ingresso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngressoCrudTest extends TestCase
{
    use RefreshDatabase;

    // ===== READ =====

    public function test_home_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_ingressos_page_loads(): void
    {
        $response = $this->get('/ingressos');

        $response->assertStatus(200);
    }

    public function test_ingressos_page_lists_all_ingressos(): void
    {
        Ingresso::factory()->count(3)->create();

        $response = $this->get('/ingressos');

        $response->assertStatus(200);
        $response->assertViewHas('ingressos');
        $this->assertCount(3, $response->viewData('ingressos'));
    }

    // ===== CREATE =====

    public function test_create_page_loads(): void
    {
        $response = $this->get('/ingressos/create');

        $response->assertStatus(200);
    }

    public function test_store_creates_ingresso(): void
    {
        $response = $this->post('/ingressos/store', [
            'jogo' => 'Brasil vs Argentina - Final',
            'setor' => 'Arquibancada Norte',
            'preco' => 350.00,
            'quantidade' => 250,
        ]);

        $response->assertRedirect('/ingressos');
        $this->assertDatabaseHas('ingressos', [
            'jogo' => 'Brasil vs Argentina - Final',
            'setor' => 'Arquibancada Norte',
            'preco' => 350.00,
            'quantidade' => 250,
        ]);
    }

    public function test_store_requires_jogo(): void
    {
        $response = $this->post('/ingressos/store', [
            'jogo' => '',
            'setor' => 'Arquibancada',
            'preco' => 50,
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('jogo');
        $this->assertDatabaseCount('ingressos', 0);
    }

    public function test_store_requires_setor(): void
    {
        $response = $this->post('/ingressos/store', [
            'jogo' => 'Brasil vs Argentina',
            'setor' => '',
            'preco' => 50,
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('setor');
        $this->assertDatabaseCount('ingressos', 0);
    }

    public function test_store_requires_preco_numeric(): void
    {
        $response = $this->post('/ingressos/store', [
            'jogo' => 'Jogo Teste',
            'setor' => 'Setor',
            'preco' => 'invalido',
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('preco');
        $this->assertDatabaseCount('ingressos', 0);
    }

    public function test_store_requires_preco_positive(): void
    {
        $response = $this->post('/ingressos/store', [
            'jogo' => 'Jogo Teste',
            'setor' => 'Setor',
            'preco' => -5,
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('preco');
    }

    public function test_store_requires_quantidade_integer(): void
    {
        $response = $this->post('/ingressos/store', [
            'jogo' => 'Jogo Teste',
            'setor' => 'Setor',
            'preco' => 50,
            'quantidade' => 'abc',
        ]);

        $response->assertSessionHasErrors('quantidade');
        $this->assertDatabaseCount('ingressos', 0);
    }

    // ===== UPDATE =====

    public function test_edit_page_loads(): void
    {
        $ingresso = Ingresso::factory()->create();

        $response = $this->get("/ingressos/{$ingresso->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('ingresso');
    }

    public function test_edit_page_404_for_invalid_id(): void
    {
        $response = $this->get('/ingressos/99999/edit');

        $response->assertStatus(404);
    }

    public function test_update_modifies_ingresso(): void
    {
        $ingresso = Ingresso::factory()->create(['jogo' => 'Jogo Antigo']);

        $response = $this->post("/ingressos/{$ingresso->id}/update", [
            'jogo' => 'Brasil vs Argentina - Final',
            'setor' => 'Camarotes VIP',
            'preco' => 1500,
            'quantidade' => 50,
        ]);

        $response->assertRedirect('/ingressos');
        $this->assertDatabaseHas('ingressos', [
            'id' => $ingresso->id,
            'jogo' => 'Brasil vs Argentina - Final',
        ]);
    }

    public function test_update_validates_input(): void
    {
        $ingresso = Ingresso::factory()->create(['jogo' => 'Original']);

        $response = $this->post("/ingressos/{$ingresso->id}/update", [
            'jogo' => '',
            'setor' => 'Setor',
            'preco' => 50,
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('jogo');
        $this->assertDatabaseHas('ingressos', [
            'id' => $ingresso->id,
            'jogo' => 'Original',
        ]);
    }

    public function test_update_404_for_invalid_id(): void
    {
        $response = $this->post('/ingressos/99999/update', [
            'jogo' => 'Jogo Teste',
            'setor' => 'Setor',
            'preco' => 50,
            'quantidade' => 10,
        ]);

        $response->assertStatus(404);
    }

    // ===== DELETE =====

    public function test_destroy_deletes_ingresso(): void
    {
        $ingresso = Ingresso::factory()->create();

        $response = $this->post("/ingressos/{$ingresso->id}/destroy");

        $response->assertRedirect('/ingressos');
        $this->assertDatabaseMissing('ingressos', ['id' => $ingresso->id]);
    }

    public function test_destroy_404_for_invalid_id(): void
    {
        $response = $this->post('/ingressos/99999/destroy');

        $response->assertStatus(404);
    }
}