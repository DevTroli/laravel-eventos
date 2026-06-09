@extends('template')

@section('titulo', 'Editar Ingresso - Copa 2026')

@section('conteudo')
<div class="container" style="padding: 3rem 1.5rem;">
    <div class="form-container">
        <h2 class="form-title">Editar Ingresso</h2>
        <p class="form-subtitle">Atualize as informações do ingresso selecionado.</p>

        <form method="post" action="{{ route('ingressos-update', $ingresso->id) }}">
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

            <div class="form-group">
                <label for="jogo">Jogo</label>
                <input type="text" id="jogo" name="jogo" value="{{ old('jogo', $ingresso->jogo) }}" required>
                <small>Nome completo do jogo</small>
            </div>

            <div class="form-group">
                <label for="setor">Setor do Estádio</label>
                <input type="text" id="setor" name="setor" value="{{ old('setor', $ingresso->setor) }}" required>
                <small>Setor onde o ingresso é válido</small>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="preco">Preço (R$)</label>
                    <input type="number" id="preco" name="preco" step="0.01"
                           value="{{ old('preco', $ingresso->preco) }}" required>
                    <small>Preço unitário do ingresso</small>
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" id="quantidade" name="quantidade"
                           value="{{ old('quantidade', $ingresso->quantidade) }}" required>
                    <small>Número de ingressos disponíveis</small>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('ingressos') }}" class="btn-cancel">Cancelar</a>
                <input type="submit" value="Atualizar Ingresso" class="btn-submit">
            </div>
        </form>
    </div>
</div>
@endsection