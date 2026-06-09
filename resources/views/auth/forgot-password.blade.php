@extends('template')

@section('titulo', 'Recuperar Senha - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Recuperar senha</h1>
            <p class="auth-subtitle">Digite seu email que enviaremos o link para redefinir sua senha.</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="seu@email.com">
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">Enviar link de recuperação</button>
        </form>

        <div class="auth-footer">
            <p><a href="{{ route('login') }}">Voltar ao login</a></p>
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
    gap: 1.25rem;
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
