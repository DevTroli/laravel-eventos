@extends('template')

@section('titulo', 'Pedidos - Admin')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">📋 Todos os Pedidos</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-outline">
            ← Voltar ao Dashboard
        </a>
    </div>

    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        @if(count($pedidos) > 0)
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
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td data-label="Pedido">#{{ $pedido->id }}</td>
                                <td data-label="Cliente">
                                    <div>
                                        <strong>{{ $pedido->cliente_nome }}</strong>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $pedido->cliente_email }}</div>
                                        @if($pedido->user)
                                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">
                                                Usuário: {{ $pedido->user->name }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td data-label="Itens">
                                    @foreach($pedido->items as $item)
                                        <div style="font-size: 0.875rem;">
                                            {{ $item->quantidade }}x {{ $item->ingresso->jogo }} ({{ $item->ingresso->setor }})
                                        </div>
                                    @endforeach
                                </td>
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
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 1rem; opacity: 0.5;">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                <p>Nenhum pedido registrado</p>
            </div>
        @endif
    </div>
</div>
@endsection