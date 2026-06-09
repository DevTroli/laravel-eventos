@extends('template')

@section('titulo', 'Quem Somos - Copa 2026')

@section('conteudo')
<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1>Quem Somos</h1>
        <p>Conheça a empresa por trás da venda de ingressos da Copa 2026</p>
    </div>
</div>

<!-- About Content -->
<div class="container">
    <div class="about-content">
        <div class="about-text">
            <h2>Líder em Venda de Ingressos para Grandes Eventos Esportivos</h2>
            <p>
                Somos uma empresa especializada na comercialização de ingressos para os maiores eventos
                esportivos do mundo. Com mais de 10 anos de experiência, estabelecemos parcerias oficiais
                com federações e organizadores de eventos em todo o globe.
            </p>
            <p>
                Para a Copa do Mundo FIFA 2026, desenvolvemos uma plataforma segura e intuitiva que permite
                aos fãs adquirirem seus ingressos de forma rápida e garantida. Nosso compromisso é oferecer
                a melhor experiência de compra, desde a seleção dos jogos até a entrega digital dos ingressos.
            </p>
            <p>
                Acreditamos que cada fã merece viver a experiência única de estar presente nos momentos
                mais emocionantes do futebol mundial. Por isso, trabalhamos incansavelmente para tornar
                esse sonho acessível a todos.
            </p>

            <div class="about-values">
                <div class="value-card">
                    <h4>🏆 Excelência</h4>
                    <p>Qualidade premium em todos os serviços</p>
                </div>
                <div class="value-card">
                    <h4>🔒 Segurança</h4>
                    <p>Transações 100% protegidas</p>
                </div>
                <div class="value-card">
                    <h4>💚 Transparência</h4>
                    <p>Preços claros, sem taxas ocultas</p>
                </div>
                <div class="value-card">
                    <h4>🎯 Compromisso</h4>
                    <p>Satisfação garantida</p>
                </div>
            </div>
        </div>

        <div class="about-image">
            ⚽
        </div>
    </div>
</div>

<!-- Stats Section -->
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">10+</div>
                <div class="stat-label">Anos de Experiência</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">500K+</div>
                <div class="stat-label">Ingressos Vendidos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div class="stat-label">Eventos Cobertos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">98%</div>
                <div class="stat-label">Customer Satisfaction</div>
            </div>
        </div>
    </div>
</section>
@endsection