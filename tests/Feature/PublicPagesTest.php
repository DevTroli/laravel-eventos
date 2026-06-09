<?php

namespace Tests\Feature;

use App\Models\Ingresso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    public function test_ingressos_page_loads(): void
    {
        $response = $this->get('/ingressos');

        $response->assertOk();
    }

    public function test_ingressos_only_shows_available(): void
    {
        Ingresso::factory()->create(['jogo' => 'Disponível FC', 'quantidade' => 10]);
        Ingresso::factory()->create(['jogo' => 'Esgotado FC', 'quantidade' => 0]);

        $response = $this->get('/ingressos');

        $response->assertOk();
        $response->assertSee('Disponível FC');
        $response->assertDontSee('Esgotado FC');
    }

    public function test_ingresso_detail_page_loads(): void
    {
        $ingresso = Ingresso::factory()->create();

        $response = $this->get("/ingresso/{$ingresso->id}");

        $response->assertOk();
    }

    public function test_sobre_page_loads(): void
    {
        $response = $this->get('/sobre');

        $response->assertOk();
    }

    public function test_contato_page_loads(): void
    {
        $response = $this->get('/contato');

        $response->assertOk();
    }

    public function test_nonexistent_ingresso_returns_404(): void
    {
        $response = $this->get('/ingresso/999');

        $response->assertNotFound();
    }
}
