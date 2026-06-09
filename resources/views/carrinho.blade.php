@extends('template')

@section('titulo', 'Carrinho - Copa 2026')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem; max-width: 800px;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">🛒 Seu Carrinho</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">Revise seus itens antes de finalizar a compra.</p>
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

    @if(count($carrinho) > 0)
        <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
            @foreach($carrinho as $item)
                <div style="padding: 1.5rem; border-bottom: 1px solid #f3f4f6; {{ $loop->last ? 'border-bottom: none;' : '' }}">
                    <div style="display: flex; justify-content: space-between; align-items: start; gap: 1rem;">
                        <div style="flex: 1;">
                            <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 0.25rem;">
                                {{ $item['nome'] }}
                            </h3>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">
                                Setor: {{ $item['setor'] }}
                            </p>
                            <p style="color: var(--text-muted); font-size: 0.75rem; margin-top: 0.5rem;">
                                R$ {{ number_format($item['preco'], 2, ',', '.') }} por unidade
                            </p>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <!-- Controles de quantidade -->
                            <form action="{{ route('carrinho.atualizar', $item['ingresso_id']) }}" method="POST" style="display: flex; align-items: center; gap: 0.5rem;">
                                @csrf
                                <button type="submit" name="quantidade" value="{{ max(1, $item['quantidade'] - 1) }}"
                                        style="width: 32px; height: 32px; border: 1px solid #e5e7eb; background: white; border-radius: 0.375rem; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                        {{ $item['quantidade'] <= 1 ? 'disabled' : '' }}>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>

                                <span style="min-width: 40px; text-align: center; font-weight: 600;">
                                    {{ $item['quantidade'] }}
                                </span>

                                <button type="submit" name="quantidade" value="{{ $item['quantidade'] + 1 }}"
                                        style="width: 32px; height: 32px; border: 1px solid #e5e7eb; background: white; border-radius: 0.375rem; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </form>

                            <!-- Subtotal -->
                            <div style="text-align: right; min-width: 100px;">
                                <p style="font-size: 1.25rem; font-weight: 700; color: #059669;">
                                    R$ {{ number_format($item['subtotal'], 2, ',', '.') }}
                                </p>
                            </div>

                            <!-- Remover -->
                            <form action="{{ route('carrinho.remover', $item['ingresso_id']) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        style="width: 32px; height: 32px; border: none; background: #fee2e2; color: #dc2626; border-radius: 0.375rem; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                        title="Remover item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Resumo do pedido -->
        <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-top: 1.5rem;">
            <h2 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1rem;">Resumo do Pedido</h2>

            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                <span style="color: var(--text-muted);">Subtotal</span>
                <span style="font-weight: 600;">R$ {{ number_format($total, 2, ',', '.') }}</span>
            </div>

            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 2px solid #e5e7eb; margin-top: 0.75rem;">
                <span style="font-size: 1.25rem; font-weight: 700;">Total</span>
                <span style="font-size: 1.5rem; font-weight: 700; color: #059669;">
                    R$ {{ number_format($total, 2, ',', '.') }}
                </span>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
                <a href="{{ route('ingressos.index') }}"
                   style="flex: 1; padding: 0.875rem 1.5rem; border: 2px solid #e5e7eb; background: white; color: #374151; text-align: center; text-decoration: none; border-radius: 0.5rem; font-weight: 600;">
                    Continuar Comprando
                </a>

                <a href="{{ route('carrinho.checkout') }}"
                   style="flex: 1; padding: 0.875rem 1.5rem; background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white; text-align: center; text-decoration: none; border-radius: 0.5rem; font-weight: 600; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);">
                    Finalizar Compra
                </a>
            </div>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">🛒</div>
            <h3 class="empty-state-title">Seu carrinho está vazio</h3>
            <p class="empty-state-description">Explore nossos ingressos disponíveis e adicione ao carrinho.</p>
            <a href="{{ route('ingressos.index') }}" class="btn-primary">Ver Ingressos</a>
        </div>
    @endif
</div>
@endsection