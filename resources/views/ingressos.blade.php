@extends('template')

@section('titulo', 'Ingressos - Copa 2026')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">🎫 Ingressos Copa 2026</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">Garanta seu lugar nos melhores jogos da Copa!</p>
    </div>

    @if(session('sucesso'))
        <div class="alert alert-success" style="background: #d1fae5; border: 1px solid #059669; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
            {{ session('sucesso') }}
        </div>
    @endif

    @if(session('erro'))
        <div class="alert alert-error" style="background: #fee2e2; border: 1px solid #dc2626; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
            {{ session('erro') }}
        </div>
    @endif

    @if($ingressos->count() > 0)
        <div class="cards-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
            @foreach($ingressos as $ingresso)
                <div class="card" style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                        <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                            {{ $ingresso->setor }}
                        </span>
                        <span style="color: var(--text-muted); font-size: 0.875rem;">#{{ $ingresso->id }}</span>
                    </div>

                    <h3 style="font-size: 1.125rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem; line-height: 1.4;">
                        {{ $ingresso->jogo }}
                    </h3>

                    <div style="margin: 1rem 0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-top: 1px solid #f3f4f6; border-bottom: 1px solid #f3f4f6;">
                            <span style="color: var(--text-muted); font-size: 0.875rem;">Preço</span>
                            <span style="font-size: 1.5rem; font-weight: 700; color: #059669;">
                                R$ {{ number_format($ingresso->preco, 2, ',', '.') }}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                            <span style="color: var(--text-muted); font-size: 0.875rem;">Disponíveis</span>
                            <span style="font-weight: 600; color: {{ $ingresso->quantidade <= 10 ? '#dc2626' : '#059669' }};">
                                {{ $ingresso->quantidade }} {{ $ingresso->quantidade == 1 ? 'unidade' : 'unidades' }}
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('carrinho.adicionar', $ingresso->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="btn-primary"
                                style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem;"
                                {{ $ingresso->quantidade <= 0 ? 'disabled' : '' }}>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            {{ $ingresso->quantidade <= 0 ? 'Esgotado' : 'Adicionar ao Carrinho' }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">🎫</div>
            <h3 class="empty-state-title">Nenhum ingresso disponível no momento</h3>
            <p class="empty-state-description">Volte em breve para novos ingressos!</p>
        </div>
    @endif

    <!-- Link para o carrinho (flutuante) -->
    @if(session('carrinho') && count(session('carrinho')) > 0)
        <a href="{{ route('carrinho.index') }}"
           style="position: fixed; bottom: 2rem; right: 2rem; background: #059669; color: white; padding: 1rem 1.5rem; border-radius: 3rem; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.4); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; z-index: 100;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            Ver Carrinho ({{ count(session('carrinho')) }})
        </a>
    @endif
</div>
@endsection