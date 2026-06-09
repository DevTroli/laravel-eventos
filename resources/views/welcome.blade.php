@extends('template')

@section('titulo', 'Início - Copa 2026')

@section('conteudo')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <span class="hero-badge">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="7"></circle>
                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
            </svg>
            Edição 2026
        </span>
        <h1 class="hero-title">Copa do Mundo FIFA 2026</h1>
        <p class="hero-subtitle">Vivencie a maior competição de futebol do planeta. Garanta seu lugar na história!</p>
        <div class="hero-actions">
            <a href="{{ route('ingressos.index') }}" class="btn-primary">
                Comprar Ingressos
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
            <a href="/" class="btn-secondary">Saiba Mais</a>
        </div>
    </div>
</section>

<!-- Ingressos em Destaque -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Em Destaque</span>
            <h2 class="section-title">Jogos Imperdíveis</h2>
            <p class="section-description">Não perca a chance de viver emoções únicas nos jogos mais esperados da Copa 2026.</p>
        </div>

        <div class="cards-grid">
            @foreach($destaques as $ingresso)
            <a href="{{ route('ingressos.show', $ingresso['id']) }}" class="card">
                <div class="card-content">
                    <div class="card-header">
                        <span class="card-tag">Destaque</span>
                    </div>
                    <h3 class="card-title">{{ $ingresso['jogo'] }}</h3>
                    <p class="card-location">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        {{ $ingresso['setor'] }}
                    </p>
                    <div class="card-meta">
                        <div>
                            <span class="card-price">R$ {{ number_format($ingresso['preco'], 2, ',', '.') }}</span>
                        </div>
                        <span class="card-quantity">{{ $ingresso['quantidade'] }} disponíveis</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('ingressos.index') }}" class="btn-outline">
                Ver Todos os Ingressos
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Por Que Nos Escolher</span>
            <h2 class="section-title">Vantagens Exclusivas</h2>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Compra Segura</h3>
                <p class="feature-description">Seus dados protegidos com tecnologia de ponta e ingressos 100% garantidos.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="22 2 11 13 2 2 2 22 22 22 22 2"></polygon>
                    </svg>
                </div>
                <h3 class="feature-title">Entrega Digital</h3>
                <p class="feature-description">Receba seus ingressos instantaneamente por e-mail ou WhatsApp.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Suporte 24/7</h3>
                <p class="feature-description">Equipe pronta para te atender a qualquer momento, antes e depois da compra.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">48</div>
                <div class="stat-label">Jogos Disponíveis</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">16</div>
                <div class="stat-label">Cidades Sede</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">5M+</div>
                <div class="stat-label">Ingressos Vendidos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">99%</div>
                <div class="stat-label">Clientes Satisfeitos</div>
            </div>
        </div>
    </div>
</section>
@endsection