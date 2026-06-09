@extends('template')

@section('titulo', 'Criar Conta - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Criar conta</h1>
            <p class="auth-subtitle">Crie sua conta para comprar ingressos e acompanhar seus pedidos.</p>
        </div>

        @if($errors->any() && !$errors->hasAny(['name', 'email', 'password', 'password_confirmation']))
            <div class="alert alert-error">
                <strong>Ops!</strong> Verifique os erros abaixo para continuar.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
            @csrf

            <div class="form-field">
                <label for="name">Nome completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Seu nome completo" class="@error('name')input-error @enderror">
                @error('name')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="seu@email.com" class="@error('email')input-error @enderror">
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required placeholder="Mínimo 8 caracteres, 1 maiúscula e 1 número" class="@error('password')input-error @enderror">
                <span class="field-hint">A senha deve ter pelo menos 8 caracteres, uma letra maiúscula e um número.</span>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="password_confirmation">Confirmar senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repita sua senha" class="@error('password_confirmation')input-error @enderror">
                @error('password_confirmation')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">Criar conta</button>
        </form>

        <div class="auth-footer">
            <p>Já tem uma conta? <a href="{{ route('login') }}">Fazer login</a></p>
        </div>
    </div>
</div>

<style>
.auth-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 80vh;
    padding: 2rem 1.5rem;
}

.auth-card {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 2.5rem;
    width: 100%;
    max-width: 440px;
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 0.5rem 0;
}

.auth-subtitle {
    font-size: 0.9375rem;
    color: var(--text-light);
    margin: 0;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-field {
    display: flex;
    flex-direction: column;
}

.form-field label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text);
    margin-bottom: 0.5rem;
}

.form-field input {
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-field input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.field-error {
    font-size: 0.8125rem;
    color: var(--error);
    margin-top: 0.375rem;
}

.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}

.auth-footer p {
    font-size: 0.9375rem;
    color: var(--text-light);
    margin: 0;
}

.auth-footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
}

.auth-footer a:hover {
    text-decoration: underline;
}
</style>
@endsection