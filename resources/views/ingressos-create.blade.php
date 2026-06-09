@extends('template')

@section('titulo', 'Novo Ingresso - Copa 2026')

@section('conteudo')
<div class="container" style="padding: 3rem 1.5rem;">
    <div class="form-container">
        <h2 class="form-title">Cadastrar Novo Ingresso</h2>
        <p class="form-subtitle">Preencha as informações abaixo para cadastrar um novo ingresso da Copa do Mundo 2026.</p>

        <form method="post" action="{{ route('ingressos-store') }}">
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

            <div class="form-group">
                <label for="jogo">Jogo</label>
                <input type="text" id="jogo" name="jogo" value="{{ old('jogo') }}"
                       placeholder="Ex: Brasil vs Argentina - Quartas de Final" required>
                <small>Nome completo do jogo (times e fase)</small>
            </div>

            <div class="form-group">
                <label for="setor">Setor do Estádio</label>
                <input type="text" id="setor" name="setor" value="{{ old('setor') }}"
                       placeholder="Ex: Arquibancada Norte, Camarotes VIP" required>
                <small>Setor onde o ingresso é válido</small>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="preco">Preço (R$)</label>
                    <input type="number" id="preco" name="preco" step="0.01"
                           value="{{ old('preco') }}" placeholder="0,00" required>
                    <small>Preço unitário do ingresso</small>
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" id="quantidade" name="quantidade"
                           value="{{ old('quantidade') }}" placeholder="0" required>
                    <small>Número de ingressos disponíveis</small>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('ingressos') }}" class="btn-cancel">Cancelar</a>
                <input type="submit" value="Cadastrar Ingresso" class="btn-submit">
            </div>
        </form>
    </div>
</div>
@endsection