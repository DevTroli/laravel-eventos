@extends('template')

@section('titulo','Eventos')

@section ('conteudo')

<h1>Eventos</h1>
<a href="{{ route('eventos-create') }}" class="btn-link">
    Adicionar Evento
</a>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Evento</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tabela as $evento)
        <tr>
            <td data-label="ID">{{ $evento->id }}</td>
            <td data-label="Evento">{{ $evento->nome }}</td>
            <td data-label="Preço">R$ {{ $evento->preco }}</td>
            <td data-label="Quantidade">{{ $evento->quantidade }}</td>
            <td data-label="Ações" class="actions">
                <a href="{{ route('eventos-edit', $evento->id) }}" class="btn-link">
                    Editar
                </a>
                <form method="POST" action="{{ route('eventos-destroy', $evento->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Excluir" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir esse evento?')">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
