<?php

namespace App\Http\Controllers;

use App\Models\Ingresso;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $ingressos = Ingresso::take(6)->get();

        $destaques = [
            [
                'jogo' => 'Final da Copa do Mundo 2026',
                'setor' => 'Cadeiras Inferiores',
                'preco' => 1500.00,
                'quantidade' => 100,
            ],
            [
                'jogo' => 'Brasil vs Argentina - Quartas de Final',
                'setor' => 'Arquibancada Norte',
                'preco' => 350.00,
                'quantidade' => 250,
            ],
            [
                'jogo' => 'Espanha vs Portugal - Semi-Final',
                'setor' => 'Camarotes VIP',
                'preco' => 2200.00,
                'quantidade' => 50,
            ],
        ];

        return view('welcome', [
            'destaques' => $destaques,
            'ingressos' => $ingressos,
        ]);
    }

    public function ingressos()
    {
        $ingressos = Ingresso::all();

        return view('ingressos', ['ingressos' => $ingressos]);
    }

    public function create()
    {
        return view('ingressos-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jogo' => 'required|string|max:255',
            'setor' => 'required|string|max:100',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        Ingresso::create([
            'jogo' => $request->jogo,
            'setor' => $request->setor,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('ingressos');
    }

    public function edit($id)
    {
        $ingresso = Ingresso::findOrFail($id);

        return view('ingressos-edit', ['ingresso' => $ingresso]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jogo' => 'required|string|max:255',
            'setor' => 'required|string|max:100',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        $ingresso = Ingresso::findOrFail($id);
        $ingresso->update([
            'jogo' => $request->jogo,
            'setor' => $request->setor,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('ingressos');
    }

    public function destroy($id)
    {
        $ingresso = Ingresso::findOrFail($id);
        $ingresso->delete();

        return redirect()->route('ingressos');
    }

    public function sobre()
    {
        return view('sobre');
    }

    public function contato()
    {
        return view('contato');
    }

    public function login()
    {
        return view('login');
    }
}
