<?php

namespace Database\Factories;

use App\Models\Ingresso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ingresso>
 */
class IngressoFactory extends Factory
{
    protected $model = Ingresso::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jogos = [
            'Brasil vs Argentina - Quartas de Final',
            'Alemanha vs França - Quartas de Final',
            'Espanha vs Portugal - Semi-Final',
            'Final da Copa do Mundo 2026',
            'México vs EUA - Oitavas de Final',
        ];

        $setores = [
            'Arquibancada Norte',
            'Arquibancada Sul',
            'Cadeiras Inferiores',
            'Cadeiras Superiores',
            'Camarotes VIP',
        ];

        return [
            'jogo' => fake()->randomElement($jogos),
            'setor' => fake()->randomElement($setores),
            'preco' => fake()->randomFloat(2, 50, 2500),
            'quantidade' => fake()->numberBetween(1, 500),
        ];
    }
}