<?php

namespace App\Http\Controllers;

use App\Models\Ingresso;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        $ingressos = [];
        $total = 0;

        foreach ($carrinho as $ingressoId => $item) {
            $ingresso = Ingresso::find($ingressoId);
            if ($ingresso) {
                $item['subtotal'] = $item['preco'] * $item['quantidade'];
                $item['nome'] = $ingresso->jogo;
                $item['setor'] = $ingresso->setor;
                $ingressos[] = $item;
                $total += $item['subtotal'];
            }
        }

        return view('carrinho', [
            'carrinho' => $ingressos,
            'total' => $total,
        ]);
    }

    public function adicionar($id)
    {
        $ingresso = Ingresso::findOrFail($id);

        if ($ingresso->quantidade <= 0) {
            return redirect()->back()->with('erro', 'Ingresso esgotado!');
        }

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            if ($carrinho[$id]['quantidade'] < $ingresso->quantidade) {
                $carrinho[$id]['quantidade']++;
                session()->put('carrinho', $carrinho);
                return redirect()->back()->with('sucesso', 'Ingresso adicionado ao carrinho!');
            } else {
                return redirect()->back()->with('erro', 'Quantidade máxima atingida!');
            }
        }

        $carrinho[$id] = [
            'ingresso_id' => $id,
            'preco' => $ingresso->preco,
            'quantidade' => 1,
        ];

        session()->put('carrinho', $carrinho);

        return redirect()->back()->with('sucesso', 'Ingresso adicionado ao carrinho!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho.index')->with('sucesso', 'Item removido do carrinho!');
    }

    public function atualizar(Request $request, $id)
    {
        $carrinho = session()->get('carrinho', []);
        $quantidade = (int) $request->input('quantidade', 1);

        if (isset($carrinho[$id])) {
            $ingresso = Ingresso::find($id);
            if ($ingresso && $quantidade <= $ingresso->quantidade && $quantidade > 0) {
                $carrinho[$id]['quantidade'] = $quantidade;
                session()->put('carrinho', $carrinho);
                return redirect()->back()->with('sucesso', 'Carrinho atualizado!');
            }
        }

        return redirect()->back()->with('erro', 'Quantidade inválida!');
    }

    public function checkout()
    {
        // Exige autenticação para checkout
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('info', 'Faça login ou crie uma conta para finalizar sua compra.');
        }

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->route('ingressos.index')->with('erro', 'Seu carrinho está vazio!');
        }

        return view('checkout');
    }

    public function confirmar(Request $request)
    {
        // Exige autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'Você precisa estar logado para finalizar a compra.');
        }

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->route('ingressos.index')->with('erro', 'Seu carrinho está vazio!');
        }

        // Calcular total e verificar disponibilidade
        $total = 0;
        $itensPedido = [];

        foreach ($carrinho as $ingressoId => $item) {
            $ingresso = Ingresso::find($ingressoId);

            if (!$ingresso || $ingresso->quantidade < $item['quantidade']) {
                return redirect()->back()->with('erro', 'Ingresso não disponível mais!');
            }

            $subtotal = $ingresso->preco * $item['quantidade'];
            $total += $subtotal;

            $itensPedido[] = [
                'ingresso' => $ingresso,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $ingresso->preco,
                'subtotal' => $subtotal,
            ];
        }

        // Criar pedido com dados do usuário logado
        $pedido = Pedido::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'completed',
            'cliente_nome' => auth()->user()->name,
            'cliente_email' => auth()->user()->email,
        ]);

        // Criar itens do pedido e decrementar estoque
        foreach ($itensPedido as $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'ingresso_id' => $item['ingresso']->id,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco_unitario'],
            ]);

            // Decrementar estoque
            $item['ingresso']->decrement('quantidade', $item['quantidade']);
        }

        // Limpar carrinho
        session()->forget('carrinho');

        return redirect()->route('pedidos.show', $pedido->id)->with('sucesso', 'Compra realizada com sucesso!');
    }

    public function meusPedidos()
    {
        // Exige autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'Faça login para visualizar seus pedidos.');
        }

        $pedidos = Pedido::where('user_id', auth()->id())
            ->with('items.ingresso')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('meus-pedidos', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::with('items.ingresso')->findOrFail($id);
        return view('pedido-detalhe', compact('pedido'));
    }
}