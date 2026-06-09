@extends('template')

@section('titulo', 'Ingressos - Copa 2026')

@section('conteudo')
<div class="container" style="padding: 3rem 1.5rem;">
    <div class="page-header">
        <h1 class="page-title">Ingressos Disponíveis</h1>
        <a href="{{ route('ingressos-create') }}" class="btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Novo Ingresso
        </a>
    </div>

    @if($ingressos->count() > 0)
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
                <td data-label="Disponíveis">{{ $ingresso->quantidade }}</td>
                <td data-label="Ações" class="actions">
                    <a href="{{ route('ingressos-edit', $ingresso->id) }}" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('ingressos-destroy', $ingresso->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Excluir" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este ingresso?')">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">📭</div>
        <h3 class="empty-state-title">Nenhum ingresso cadastrado</h3>
        <p class="empty-state-description">Comece adicionando o primeiro ingresso ao sistema.</p>
        <a href="{{ route('ingressos-create') }}" class="btn-primary">Cadastrar Ingresso</a>
    </div>
    @endif
</div>
@endsection