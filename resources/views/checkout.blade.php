@extends('template')

@section('titulo', 'Checkout - Copa 2026')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem; max-width: 700px;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">Finalizar Compra</h1>
        <p style="color: var(--text-light); margin-top: 0.5rem;">Revise seu pedido e confirme a compra.</p>
    </div>

    @if(session('erro'))
        <div class="alert alert-error" style="background: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.2); color: var(--error); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            {{ session('erro') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert" style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.2); color: var(--primary); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            {{ session('info') }}
        </div>
    @endif

    <div class="checkout-container">
        <div class="checkout-info">
            <h2 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1rem;">Informações do Comprador</h2>
            <div class="buyer-info">
                <p><strong>Nome:</strong> {{ auth()->check() ? auth()->user()->name : 'Visitante' }}</p>
                <p><strong>Email:</strong> {{ auth()->check() ? auth()->user()->email : 'Visitante' }}</p>
            </div>
            @auth
                <p style="font-size: 0.875rem; color: var(--text-light); margin-top: 1rem;">
                    Os ingressos serão enviados para este email após a confirmação.
                </p>
            @endauth
        </div>

        <div class="checkout-summary">
            <h2 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1rem;">Resumo do Pedido</h2>

            @php
                $carrinho = session()->get('carrinho', []);
                $total = 0;
            @endphp

            <div class="order-items">
                @foreach($carrinho as $ingressoId => $item)
                    @php
                        $ingresso = \App\Models\Ingresso::find($ingressoId);
                        if ($ingresso) {
                            $subtotal = $item['preco'] * $item['quantidade'];
                            $total += $subtotal;
                        }
                    @endphp
                    <div class="order-item">
                        <div>
                            <p class="order-item-name">{{ $ingresso->jogo ?? 'Ingresso' }}</p>
                            <p class="order-item-detail">{{ $item['quantidade'] }}x {{ $ingresso->setor ?? '' }}</p>
                        </div>
                        <span class="order-item-price">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="order-total">
                <span>Total</span>
                <span class="total-value">R$ {{ number_format($total, 2, ',', '.') }}</span>
            </div>
        </div>

        <div class="checkout-footer">
            <a href="{{ route('carrinho.index') }}" class="btn-secondary" style="flex: 1; text-decoration: none;">
                Voltar
            </a>

            <form action="{{ route('carrinho.confirmar') }}" method="POST" style="flex: 1;">
                @csrf
                <button type="submit" class="btn-primary" style="width: 100%;">
                    Confirmar Compra
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.checkout-container {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 2rem;
}

.checkout-info {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--border);
}

.checkout-info h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 1rem;
}

.buyer-info p {
    font-size: 0.9375rem;
    color: var(--text);
    margin: 0.5rem 0;
}

.checkout-summary {
    margin-bottom: 2rem;
}

.checkout-summary h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 1rem;
}

.order-items {
    margin-bottom: 1.5rem;
}

.order-item {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border);
}

.order-item:last-child {
    border-bottom: none;
}

.order-item-name {
    font-weight: 600;
    color: var(--text);
    margin: 0 0 0.25rem 0;
}

.order-item-detail {
    font-size: 0.875rem;
    color: var(--text-light);
    margin: 0;
}

.order-item-price {
    font-weight: 600;
    color: var(--success);
}

.order-total {
    display: flex;
    justify-content: space-between;
    padding-top: 1.5rem;
    margin-top: 1rem;
    border-top: 2px solid var(--border);
    font-size: 1.25rem;
    font-weight: 700;
}

.total-value {
    color: var(--success);
}

.checkout-footer {
    display: flex;
    gap: 1rem;
}
</style>
@endsection