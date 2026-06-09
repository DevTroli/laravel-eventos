@extends('template')

@section('titulo', 'Quem Somos - Copa 2026')

@section('conteudo')
<section class="section">
    <div class="container">
        <div class="about-intro">
            <h1 class="about-title">Copa 2026 Ingressos</h1>
            <p class="about-lead">Plataforma oficial de comercialização de ingressos para a Copa do Mundo FIFA 2026.</p>
        </div>

        <div class="about-grid">
            <div class="about-block">
                <h2>A Empresa</h2>
                <p>Somos uma empresa brasileira especializada em comercialização de ingressos para eventos esportivos internacionais. Com mais de 10 anos de mercado, atuamos como parceira oficial de federações e organizadoras de eventos em todo o mundo.</p>
            </div>

            <div class="about-block">
                <h2>O Evento</h2>
                <p>A Copa do Mundo FIFA 2026 será realizada de 11 de junho a 19 de julho de 2026, com sedes em 16 cidades dos Estados Unidos, Canadá e México. Será a primeira edição com 48 seleções, totalizando 104 partidas.</p>
            </div>
        </div>

        <div class="stats-section">
            <div class="stat-item">
                <span class="stat-number">104</span>
                <span class="stat-label">Jogos</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">48</span>
                <span class="stat-label">Seleções</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">16</span>
                <span class="stat-label">Cidades-sede</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">3</span>
                <span class="stat-label">Países</span>
            </div>
        </div>

        <div class="values-section">
            <h2>Nossos Valores</h2>
            <div class="values-grid">
                <div class="value-item">
                    <h3>Transparência</h3>
                    <p>Preços claros, sem taxas ocultas. Você sabe exatamente pelo que está pagando.</p>
                </div>
                <div class="value-item">
                    <h3>Segurança</h3>
                    <p>Todos os ingressos são verificados e garantidos, com certificado de autenticidade.</p>
                </div>
                <div class="value-item">
                    <h3>Atendimento</h3>
                    <p>Equipe dedicada para apoiar você em cada etapa, da compra ao dia do jogo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.about-intro {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 4rem;
    padding-top: 2rem;
}

.about-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 1rem 0;
    letter-spacing: -0.02em;
}

.about-lead {
    font-size: 1.125rem;
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.about-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.about-block {
    padding: 2rem;
    border-left: 3px solid var(--primary);
}

.about-block h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 1rem 0;
}

.about-block p {
    color: var(--text-light);
    line-height: 1.7;
    margin: 0;
}

.stats-section {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    padding: 3rem 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    margin-bottom: 4rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-size: 3rem;
    font-weight: 700;
    color: var(--primary);
    line-height: 1;
}

.stat-label {
    display: block;
    font-size: 0.875rem;
    color: var(--text-light);
    margin-top: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.values-section {
    text-align: center;
}

.values-section h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 2rem 0;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.value-item {
    padding: 1.5rem;
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: 8px;
}

.value-item h3 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 0.75rem 0;
}

.value-item p {
    color: var(--text-light);
    font-size: 0.9375rem;
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 768px) {
    .stats-section {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-number {
        font-size: 2.5rem;
    }
}
</style>
@endsection