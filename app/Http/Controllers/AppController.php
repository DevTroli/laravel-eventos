<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $tb_eventos = Evento::all();

        $frase = 'Laravel é uma coisa muito ruim';

        $eventos = [
            [
                'nome' => 'Laravel Básico',
                'preco' => 50.50,
                'vagas' => 150,
            ],
            [
                'nome' => 'Laravel Intermediario',
                'preco' => 35.50,
                'vagas' => 60,
            ],
        ];

        return view('welcome', ['texto' => $frase, 'event' => $eventos, 'tabela' => $tb_eventos]);
    }

    public function eventos()
    {
        $tb_eventos = Evento::all();

        return view('eventos', ['tabela' => $tb_eventos]);
    }

    public function create()
    {
        return view('eventos-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        Evento::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('eventos');
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);

        return view('eventos-edit', ['evento' => $evento]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        $evento = Evento::findOrFail($id);

        $evento->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('eventos');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos');
    }
}
