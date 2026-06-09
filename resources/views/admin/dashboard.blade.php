@extends('template')

@section('titulo', 'Dashboard - Admin')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">📊 Dashboard Administrativo</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">Visão geral das vendas de ingressos.</p>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: var(--bg-white); border: 1px solid var(--border); border-left: 4px solid var(--success); color: var(--text); padding: 1.5rem; border-radius: 0.75rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
                <span style="font-size: 0.875rem; color: var(--text-light);">Receita Total</span>
            </div>
            <p style="font-size: 2rem; font-weight: 700; color: var(--text);">R$ {{ number_format($totalVendas, 2, ',', '.') }}</p>
        </div>

        <div style="background: var(--bg-white); border: 1px solid var(--border); border-left: 4px solid var(--primary); color: var(--text); padding: 1.5rem; border-radius: 0.75rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                <span style="font-size: 0.875rem; color: var(--text-light);">Pedidos</span>
            </div>
            <p style="font-size: 2rem; font-weight: 700; color: var(--text);">{{ $totalPedidos }}</p>
        </div>

        <div style="background: var(--bg-white); border: 1px solid var(--border); border-left: 4px solid var(--warning); color: var(--text); padding: 1.5rem; border-radius: 0.75rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--warning)" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <span style="font-size: 0.875rem; color: var(--text-light);">Ingressos Vendidos</span>
            </div>
            <p style="font-size: 2rem; font-weight: 700; color: var(--text);">{{ $totalIngressosVendidos }}</p>
        </div>
    </div>

    <!-- Links Rápidos -->
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
        <a href="{{ route('admin.ingressos.index') }}" class="btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Gerenciar Ingressos
        </a>
        <a href="{{ route('admin.pedidos.index') }}" class="btn-outline">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
            </svg>
            Ver Todos Pedidos
        </a>
        <a href="{{ route('ingressos.index') }}" class="btn-outline">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            Ver Loja
        </a>
    </div>

    <!-- Últimos Pedidos -->
    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
            <h2 style="font-size: 1.125rem; font-weight: 700; color: #1f2937;">Últimos Pedidos</h2>
        </div>

        @if(count($pedidosRecentes) > 0)
            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Itens</th>
                            <th>Total</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidosRecentes as $pedido)
                            <tr>
                                <td data-label="Pedido">#{{ $pedido->id }}</td>
                                <td data-label="Cliente">
                                    <div>
                                        <strong>{{ $pedido->cliente_nome }}</strong>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $pedido->cliente_email }}</div>
                                    </div>
                                </td>
                                <td data-label="Itens">{{ $pedido->items->sum('quantidade') }} ingresso(s)</td>
                                <td data-label="Total">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                                <td data-label="Data">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                <td data-label="Status">
                                    <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                        {{ ucfirst($pedido->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 3rem; text-align: center; color: var(--text-muted);">
                Nenhum pedido registrado
            </div>
        @endif
    </div>
</div>
@endsection