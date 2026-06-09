<?php

namespace Tests\Feature;

use App\Models\Evento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventoCrudTest extends TestCase
{
    use RefreshDatabase;

    // ===== READ =====

    public function test_home_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_eventos_page_loads(): void
    {
        $response = $this->get('/eventos');

        $response->assertStatus(200);
    }

    public function test_eventos_page_lists_all_eventos(): void
    {
        Evento::factory()->count(3)->create();

        $response = $this->get('/eventos');

        $response->assertStatus(200);
        $response->assertViewHas('tabela');
        $this->assertCount(3, $response->viewData('tabela'));
    }

    // ===== CREATE =====

    public function test_create_page_loads(): void
    {
        $response = $this->get('/eventos/create');

        $response->assertStatus(200);
    }

    public function test_store_creates_evento(): void
    {
        $response = $this->post('/eventos/store', [
            'nome' => 'Laravel Avançado',
            'preco' => 99.90,
            'quantidade' => 50,
        ]);

        $response->assertRedirect('/eventos');
        $this->assertDatabaseHas('eventos', [
            'nome' => 'Laravel Avançado',
            'preco' => 99.90,
            'quantidade' => 50,
        ]);
    }

    public function test_store_requires_nome(): void
    {
        $response = $this->post('/eventos/store', [
            'nome' => '',
            'preco' => 50,
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('nome');
        $this->assertDatabaseCount('eventos', 0);
    }

    public function test_store_requires_preco_numeric(): void
    {
        $response = $this->post('/eventos/store', [
            'nome' => 'Evento',
            'preco' => 'invalido',
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('preco');
        $this->assertDatabaseCount('eventos', 0);
    }

    public function test_store_requires_preco_positive(): void
    {
        $response = $this->post('/eventos/store', [
            'nome' => 'Evento',
            'preco' => -5,
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('preco');
    }

    public function test_store_requires_quantidade_integer(): void
    {
        $response = $this->post('/eventos/store', [
            'nome' => 'Evento',
            'preco' => 50,
            'quantidade' => 'abc',
        ]);

        $response->assertSessionHasErrors('quantidade');
        $this->assertDatabaseCount('eventos', 0);
    }

    // ===== UPDATE =====

    public function test_edit_page_loads(): void
    {
        $evento = Evento::factory()->create();

        $response = $this->get("/eventos/{$evento->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('evento');
    }

    public function test_edit_page_404_for_invalid_id(): void
    {
        $response = $this->get('/eventos/99999/edit');

        $response->assertStatus(404);
    }

    public function test_update_modifies_evento(): void
    {
        $evento = Evento::factory()->create(['nome' => 'Antes']);

        $response = $this->post("/eventos/{$evento->id}/update", [
            'nome' => 'Depois',
            'preco' => 100,
            'quantidade' => 30,
        ]);

        $response->assertRedirect('/eventos');
        $this->assertDatabaseHas('eventos', [
            'id' => $evento->id,
            'nome' => 'Depois',
        ]);
    }

    public function test_update_validates_input(): void
    {
        $evento = Evento::factory()->create(['nome' => 'Original']);

        $response = $this->post("/eventos/{$evento->id}/update", [
            'nome' => '',
            'preco' => 50,
            'quantidade' => 10,
        ]);

        $response->assertSessionHasErrors('nome');
        $this->assertDatabaseHas('eventos', [
            'id' => $evento->id,
            'nome' => 'Original',
        ]);
    }

    public function test_update_404_for_invalid_id(): void
    {
        $response = $this->post('/eventos/99999/update', [
            'nome' => 'Teste',
            'preco' => 50,
            'quantidade' => 10,
        ]);

        $response->assertStatus(404);
    }

    // ===== DELETE =====

    public function test_destroy_deletes_evento(): void
    {
        $evento = Evento::factory()->create();

        $response = $this->post("/eventos/{$evento->id}/destroy");

        $response->assertRedirect('/eventos');
        $this->assertDatabaseMissing('eventos', ['id' => $evento->id]);
    }

    public function test_destroy_404_for_invalid_id(): void
    {
        $response = $this->post('/eventos/99999/destroy');

        $response->assertStatus(404);
    }
}
