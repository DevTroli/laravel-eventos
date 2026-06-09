<?php

namespace App\Http\Controllers;

use App\Models\Ingresso;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Métodos públicos (e-commerce)
    public function ingressosIndexPublic()
    {
        $ingressos = Ingresso::where('quantidade', '>', 0)->orderBy('created_at', 'desc')->get();
        return view('ingressos', compact('ingressos'));
    }

    public function show($id)
    {
        $ingresso = Ingresso::findOrFail($id);
        return view('ingressos-detalhe', compact('ingresso'));
    }

    // Métodos admin (requer auth)
    public function dashboard()
    {
        // Stats gerais
        $totalVendas = Pedido::where('status', 'completed')->sum('total');
        $totalPedidos = Pedido::where('status', 'completed')->count();
        $totalIngressosVendidos = PedidoItem::join('pedidos', 'pedido_items.pedido_id', '=', 'pedidos.id')
            ->where('pedidos.status', 'completed')
            ->sum('pedido_items.quantidade');

        // Últimos pedidos
        $pedidosRecentes = Pedido::with(['user', 'items.ingresso'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', [
            'totalVendas' => $totalVendas,
            'totalPedidos' => $totalPedidos,
            'totalIngressosVendidos' => $totalIngressosVendidos,
            'pedidosRecentes' => $pedidosRecentes,
        ]);
    }

    public function ingressosIndex()
    {
        $this->middleware('auth');
        $ingressos = Ingresso::orderBy('created_at', 'desc')->get();
        return view('admin.ingressos.index', compact('ingressos'));
    }

    public function ingressosCreate()
    {
        return view('admin.ingressos.create');
    }

    public function ingressosStore(Request $request)
    {
        $request->validate([
            'jogo' => 'required|string|max:100',
            'setor' => 'required|string|max:50',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        Ingresso::create($request->all());

        return redirect()->route('admin.ingressos.index')->with('sucesso', 'Ingresso cadastrado com sucesso!');
    }

    public function ingressosEdit($id)
    {
        $ingresso = Ingresso::findOrFail($id);
        return view('admin.ingressos.edit', compact('ingresso'));
    }

    public function ingressosUpdate(Request $request, $id)
    {
        $request->validate([
            'jogo' => 'required|string|max:100',
            'setor' => 'required|string|max:50',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        $ingresso = Ingresso::findOrFail($id);
        $ingresso->update($request->all());

        return redirect()->route('admin.ingressos.index')->with('sucesso', 'Ingresso atualizado com sucesso!');
    }

    public function ingressosDestroy($id)
    {
        $ingresso = Ingresso::findOrFail($id);
        $ingresso->delete();

        return redirect()->route('admin.ingressos.index')->with('sucesso', 'Ingresso excluído com sucesso!');
    }

    public function pedidosIndex()
    {
        $pedidos = Pedido::with(['user', 'items.ingresso'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pedidos.index', compact('pedidos'));
    }
}