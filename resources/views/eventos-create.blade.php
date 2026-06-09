@extends('template')

@section('titulo','Eventos')

@section ('conteudo')

<h1>Novo Evento</h1>

<form method="post" action="{{ route('eventos-store') }}" class="form-crud">
    @csrf

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
    <input type="text" name="nome" value="{{ old('nome') }}" required>

    <label>Preço</label>
    <input type="number" name="preco" step="0.01" value="{{ old('preco') }}" required>

    <label>Quantidade</label>
    <input type="number" name="quantidade" value="{{ old('quantidade') }}" required>

    <input type="submit" value="Salvar" class="btn-submit">

</form>


@endsection
