@extends('template')

@section('titulo', 'Esqueceu a Senha - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Esqueceu a senha?</h1>
            <p class="auth-subtitle">Informe seu email e enviaremos um link para redefinir sua senha</p>
        </div>

        @if (session('status'))
        <div class="auth-alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="seu@email.com">
                @error('email')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Enviar link de redefinição</button>
        </form>

        <div class="auth-footer">
            <p><a href="{{ route('login') }}">Voltar para login</a></p>
        </div>
    </div>
</div>
@endsection
