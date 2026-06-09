@extends('template')

@section('titulo', 'Confirmar Senha - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Confirmar senha</h1>
            <p class="auth-subtitle">Esta é uma área segura. Confirme sua senha antes de continuar.</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
            @csrf

            <div class="form-field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Digite sua senha">
                @error('password')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Confirmar</button>
        </form>

        <div class="auth-footer">
            <p><a href="{{ route('login') }}">Voltar para login</a></p>
        </div>
    </div>
</div>
@endsection
