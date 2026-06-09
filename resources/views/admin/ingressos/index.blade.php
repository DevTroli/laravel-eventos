@extends('template')

@section('titulo', 'Gerenciar Ingressos - Admin')

@section('conteudo')
<div class="container" style="padding: 2rem 1.5rem;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">🎫 Gerenciar Ingressos</h1>
        <a href="{{ route('admin.ingressos.create') }}" class="btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Novo Ingresso
        </a>
    </div>

    @if(session('sucesso'))
        <div class="alert alert-success" style="background: #d1fae5; border: 1px solid #059669; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        @if($ingressos->count() > 0)
            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jogo</th>
                            <th>Setor</th>
                            <th>Preço</th>
                            <th>Disponíveis</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ingressos as $ingresso)
                            <tr>
                                <td data-label="ID">#{{ $ingresso->id }}</td>
                                <td data-label="Jogo">{{ $ingresso->jogo }}</td>
                                <td data-label="Setor">{{ $ingresso->setor }}</td>
                                <td data-label="Preço">R$ {{ number_format($ingresso->preco, 2, ',', '.') }}</td>
                                <td data-label="Disponíveis">
                                    <span style="color: {{ $ingresso->quantidade <= 10 ? '#dc2626' : '#059669' }}; font-weight: 600;">
                                        {{ $ingresso->quantidade }}
                                    </span>
                                </td>
                                <td data-label="Ações" class="actions">
                                    <a href="{{ route('admin.ingressos.edit', $ingresso->id) }}" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.ingressos.destroy', $ingresso->id) }}" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este ingresso?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Excluir" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem; background: #fee2e2; border-color: #dc2626; color: #dc2626;">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 3rem; text-align: center; color: var(--text-muted);">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 1rem; opacity: 0.5;">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                <p>Nenhum ingresso cadastrado</p>
            </div>
        @endif
    </div>
</div>
@endsection