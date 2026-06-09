<?php

namespace Database\Seeders;

use App\Models\Ingresso;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Popula o banco com ingressos de exemplo da Copa 2026.
     */
    public function run(): void
    {
        // Cria ingressos de exemplo para a Copa 2026
        Ingresso::create([
            'jogo' => 'Brasil vs Argentina - Quartas de Final',
            'setor' => 'Arquibancada Norte',
            'preco' => 350.00,
            'quantidade' => 250,
        ]);

        Ingresso::create([
            'jogo' => 'Brasil vs Argentina - Quartas de Final',
            'setor' => 'Cadeiras Inferiores',
            'preco' => 850.00,
            'quantidade' => 100,
        ]);

        Ingresso::create([
            'jogo' => 'Final da Copa do Mundo 2026',
            'setor' => 'Arquibancada Sul',
            'preco' => 500.00,
            'quantidade' => 300,
        ]);

        Ingresso::create([
            'jogo' => 'Final da Copa do Mundo 2026',
            'setor' => 'Cadeiras Superiores',
            'preco' => 1200.00,
            'quantidade' => 150,
        ]);

        Ingresso::create([
            'jogo' => 'Final da Copa do Mundo 2026',
            'setor' => 'Camarotes VIP',
            'preco' => 2500.00,
            'quantidade' => 50,
        ]);

        Ingresso::create([
            'jogo' => 'Alemanha vs França - Quartas de Final',
            'setor' => 'Arquibancada Norte',
            'preco' => 320.00,
            'quantidade' => 200,
        ]);

        Ingresso::create([
            'jogo' => 'Espanha vs Portugal - Semi-Final',
            'setor' => 'Cadeiras Inferiores',
            'preco' => 950.00,
            'quantidade' => 80,
        ]);

        Ingresso::create([
            'jogo' => 'México vs EUA - Oitavas de Final',
            'setor' => 'Arquibancada Sul',
            'preco' => 280.00,
            'quantidade' => 400,
        ]);
    }
}