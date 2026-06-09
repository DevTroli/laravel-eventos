@extends('template')

@section('titulo','Eventos')

@section ('conteudo')

<h1>Editar Evento</h1>

<form method="post" action="{{ route('eventos-update', $evento->id) }}" class="form-crud">
    @csrf
    @method('PUT')

    @if($errors->any())
    <div class="validation-errors">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <label>Evento</label>
    <input type="text" name="nome" value="{{ old('nome', $evento->nome) }}" required>

    <label>Preço</label>
    <input type="number" name="preco" value="{{ old('preco', $evento->preco) }}" step="0.01" required>

    <label>Quantidade</label>
    <input type="number" name="quantidade" value="{{ old('quantidade', $evento->quantidade) }}" required>

    <input type="submit" value="Salvar" class="btn-submit">

</form>


@endsection
