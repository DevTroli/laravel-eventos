@extends('template')

@section('titulo', 'Meus Pedidos')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem; max-width: 800px;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">📦 Meus Pedidos</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">Histórico das suas compras de ingressos.</p>
    </div>

    @if($pedidos->count() > 0)
        <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
            @foreach($pedidos as $pedido)
                <div style="padding: 1.5rem; border-bottom: 1px solid #f3f4f6; {{ $loop->last ? 'border-bottom: none;' : '' }}">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                        <div>
                            <h3 style="font-size: 1.125rem; font-weight: 700; color: #1f2937;">
                                Pedido #{{ $pedido->id }}
                            </h3>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">
                                {{ $pedido->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                            {{ ucfirst($pedido->status) }}
                        </span>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        @foreach($pedido->items as $item)
                            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; font-size: 0.875rem;">
                                <span>
                                    {{ $item->quantidade }}x {{ $item->ingresso->jogo }} - {{ $item->ingresso->setor }}
                                </span>
                                <span style="color: #059669; font-weight: 600;">
                                    R$ {{ number_format($item->preco_unitario * $item->quantidade, 2, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #f3f4f6;">
                        <span style="font-size: 1.125rem; font-weight: 700;">Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn-outline">
                            Ver Detalhes
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📦</div>
            <h3 class="empty-state-title">Nenhum pedido ainda</h3>
            <p class="empty-state-description">Quando você fizer sua primeira compra, ela aparecerá aqui!</p>
            <a href="{{ route('ingressos.index') }}" class="btn-primary" style="margin-top: 1rem;">
                Ver Ingressos
            </a>
        </div>
    @endif
</div>
@endsection