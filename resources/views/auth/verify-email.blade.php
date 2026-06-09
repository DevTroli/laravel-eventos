@extends('template')

@section('titulo', 'Verificar Email - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Verificar email</h1>
            <p class="auth-subtitle">Obrigado por se cadastrar! Clique no link que enviamos para seu email para verificar sua conta.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="auth-alert">
            Um novo link de verificação foi enviado para o email informado no cadastro.
        </div>
        @endif

        <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1.5rem;">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary" style="width: 100%;">Reenviar email de verificação</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-outline" style="width: 100%; text-align: center;">Sair</button>
            </form>
        </div>
    </div>
</div>
@endsection
