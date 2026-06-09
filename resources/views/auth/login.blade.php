@extends('template')

@section('titulo', 'Entrar - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Entrar</h1>
            <p class="auth-subtitle">Acesse sua conta para comprar ingressos</p>
        </div>

        @if (session('status'))
        <div class="auth-alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="seu@email.com">
                @error('email')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Digite sua senha">
                @error('password')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember">
                    Lembrar de mim
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Esqueceu a senha?</a>
                @endif
            </div>

            <button type="submit" class="btn-primary">Entrar</button>
        </form>

        <div class="auth-footer">
            <p>Não tem conta? <a href="{{ route('register') }}">Criar conta</a></p>
        </div>
    </div>
</div>
@endsection
