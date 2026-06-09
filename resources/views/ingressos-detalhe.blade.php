@extends('template')

@section('titulo', $ingresso->jogo . ' - Copa 2026')

@section('conteudo')
<section class="section">
    <div class="container">
        <div class="detail-header">
            <a href="{{ route('ingressos.index') }}" class="back-link">
                ← Voltar para ingressos
            </a>
        </div>

        <div class="detail-grid">
            <div class="detail-info">
                <h1 class="detail-title">{{ $ingresso->jogo }}</h1>
                <p class="detail-sector">{{ $ingresso->setor }}</p>

                <div class="detail-price">
                    <span class="price-label">Preço</span>
                    <span class="price-value">R$ {{ number_format($ingresso->preco, 2, ',', '.') }}</span>
                </div>

                <div class="detail-quantity">
                    <span class="quantity-label">Disponibilidade</span>
                    @if($ingresso->quantidade > 10)
                        <span class="quantity-status available">
                            {{ $ingresso->quantidade }} ingressos disponíveis
                        </span>
                    @elseif($ingresso->quantidade > 0)
                        <span class="quantity-status low">
                            Últimos {{ $ingresso->quantidade }} ingressos!
                        </span>
                    @else
                        <span class="quantity-status sold-out">
                            Esgotado
                        </span>
                    @endif
                </div>

                <div class="detail-actions">
                    @if($ingresso->quantidade > 0)
                        <form action="{{ route('carrinho.adicionar', $ingresso->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-add-cart">
                                Adicionar ao Carrinho
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                            </button>
                        </form>
                    @else
                        <button class="btn-disabled" disabled>
                            Esgotado
                        </button>
                    @endif
                </div>
            </div>

            <div class="detail-sidebar">
                <div class="info-card">
                    <h3>Informações do Ingresso</h3>
                    <ul class="info-list">
                        <li>
                            <span class="info-label">Evento</span>
                            <span class="info-value">Copa do Mundo FIFA 2026</span>
                        </li>
                        <li>
                            <span class="info-label">Setor</span>
                            <span class="info-value">{{ $ingresso->setor }}</span>
                        </li>
                        <li>
                            <span class="info-label">Entrega</span>
                            <span class="info-value">Digital (PDF + QR Code)</span>
                        </li>
                    </ul>
                </div>

                <div class="info-card highlight">
                    <h3>Garantia de Compra Segura</h3>
                    <ul class="guarantee-list">
                        <li>✓ Ingresso 100% original</li>
                        <li>✓ Entrega imediata por email</li>
                        <li>✓ Suporte especializado</li>
                        <li>✓ Proteção ao comprador</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.detail-header {
    margin-bottom: 2rem;
}

.back-link {
    display: inline-flex;
    align-items: center;
    color: var(--text-light);
    text-decoration: none;
    font-size: 0.9375rem;
    transition: color 0.2s;
}

.back-link:hover {
    color: var(--primary);
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 3rem;
}

.detail-info {
    padding-right: 2rem;
}

.detail-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 0.5rem 0;
}

.detail-sector {
    font-size: 1.125rem;
    color: var(--text-light);
    margin: 0 0 2rem 0;
}

.detail-price {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.price-label {
    display: block;
    font-size: 0.875rem;
    color: var(--text-light);
    margin-bottom: 0.5rem;
}

.price-value {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary);
}

.detail-quantity {
    margin-bottom: 2rem;
}

.quantity-label {
    display: block;
    font-size: 0.875rem;
    color: var(--text-light);
    margin-bottom: 0.5rem;
}

.quantity-status {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
}

.quantity-status.available {
    background: rgba(5, 150, 105, 0.1);
    color: var(--success);
}

.quantity-status.low {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
}

.quantity-status.sold-out {
    background: rgba(220, 38, 38, 0.1);
    color: var(--error);
}

.detail-actions {
    margin-top: 2rem;
}

.btn-add-cart {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    width: 100%;
    justify-content: center;
    padding: 1rem 2rem;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-add-cart:hover {
    background: var(--primary-dark);
}

.btn-disabled {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 1rem 2rem;
    background: var(--bg);
    color: var(--text-light);
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: not-allowed;
}

.detail-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-card {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.5rem;
}

.info-card h3 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 1rem 0;
}

.info-card.highlight {
    border-color: var(--primary);
    background: rgba(99, 102, 241, 0.02);
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border);
    font-size: 0.9375rem;
}

.info-list li:last-child {
    border-bottom: none;
}

.info-label {
    color: var(--text-light);
}

.info-value {
    font-weight: 500;
    color: var(--text);
    text-align: right;
}

.guarantee-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.guarantee-list li {
    padding: 0.625rem 0;
    color: var(--text);
    font-size: 0.9375rem;
}

.guarantee-list li::before {
    color: var(--success);
    font-weight: 600;
}

@media (max-width: 900px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }

    .detail-sidebar {
        order: -1;
    }
}
</style>
@endsection