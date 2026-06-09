<?php

namespace Database\Seeders;

use App\Models\Ingresso;
use Illuminate\Database\Seeder;

class IngressoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingresso::create([
            'jogo' => 'Brasil vs Argentina',
            'setor' => 'Setor Sul',
            'preco' => 1500.00,
            'quantidade' => 50,
        ]);

        Ingresso::create([
            'jogo' => 'Brasil vs Alemanha',
            'setor' => 'Setor Norte',
            'preco' => 1800.00,
            'quantidade' => 30,
        ]);

        Ingresso::create([
            'jogo' => 'Argentina vs Espanha',
            'setor' => 'Geral',
            'preco' => 950.00,
            'quantidade' => 100,
        ]);

        Ingresso::create([
            'jogo' => 'França vs Portugal',
            'setor' => 'Premium',
            'preco' => 2200.00,
            'quantidade' => 20,
        ]);

        Ingresso::create([
            'jogo' => 'Brasil vs França',
            'setor' => ' Arquibancada',
            'preco' => 680.00,
            'quantidade' => 200,
        ]);
    }
}
