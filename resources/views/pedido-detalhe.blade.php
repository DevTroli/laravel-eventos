@extends('template')

@section('titulo', 'Detalhes do Pedido')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem; max-width: 800px;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">📦 Pedido #{{ $pedido->id }}</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">
            {{ $pedido->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1rem;">Dados do Cliente</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
                <p style="color: var(--text-muted); font-size: 0.875rem;">Nome</p>
                <p style="font-weight: 600;">{{ $pedido->cliente_nome }}</p>
            </div>
            <div>
                <p style="color: var(--text-muted); font-size: 0.875rem;">E-mail</p>
                <p style="font-weight: 600;">{{ $pedido->cliente_email }}</p>
            </div>
        </div>
    </div>

    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1rem;">Itens do Pedido</h2>

        @foreach($pedido->items as $item)
            <div style="padding: 1rem 0; border-bottom: 1px solid #f3f4f6; {{ $loop->last ? 'border-bottom: none;' : '' }}">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <p style="font-weight: 600; color: #1f2937;">{{ $item->ingresso->jogo }}</p>
                        <p style="color: var(--text-muted); font-size: 0.875rem;">
                            Setor: {{ $item->ingresso->setor }}
                        </p>
                        <p style="color: var(--text-muted); font-size: 0.875rem;">
                            Quantidade: {{ $item->quantidade }}
                        </p>
                    </div>
                    <div style="text-align: right;">
                        <p style="font-size: 0.875rem; color: var(--text-muted);">
                            R$ {{ number_format($item->preco_unitario, 2, ',', '.') }} cada
                        </p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: #059669;">
                            R$ {{ number_format($item->preco_unitario * $item->quantidade, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem;">
        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-top: 2px solid #e5e7eb;">
            <span style="font-size: 1.25rem; font-weight: 700;">Total Pago</span>
            <span style="font-size: 1.5rem; font-weight: 700; color: #059669;">
                R$ {{ number_format($pedido->total, 2, ',', '.') }}
            </span>
        </div>
    </div>

    <div style="margin-top: 1.5rem;">
        <a href="{{ route('pedidos.index') }}" class="btn-outline">← Voltar aos Meus Pedidos</a>
    </div>
</div>
@endsection