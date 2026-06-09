@extends('template')

@section('titulo','Home')

@section('conteudo')
<h1>Laravel</h1>

<p>{{ $texto }}</p>

<h2>Nossos Eventos</h2>

@if($event)
    @foreach($event as $e)
        <p>Evento: {{ $e['nome'] }} <br>
        Preço: R${{ $e['preco'] }} <br>
        Vagas: {{ $e['vagas'] }}
        </p>
        <hr>
    @endforeach

    @foreach($tabela as $tab)
        <p>Evento: {{ $tab['nome'] }} <br>
        Preço: R${{ $tab['preco'] }} <br>
        Vagas: {{ $tab['quantidade'] }}
        </p>
        <hr>
    @endforeach
@else
    <p>nenhum evento disponivel.</p>
@endif
@endsection
