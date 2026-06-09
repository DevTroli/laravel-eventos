@extends('template')

@section('titulo', 'Redefinir Senha - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Redefinir senha</h1>
            <p class="auth-subtitle">Crie sua nova senha</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="auth-form">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="seu@email.com">
                @error('email')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="password">Nova senha</label>
                <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                @error('password')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="password_confirmation">Confirmar nova senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Repita a nova senha">
                @error('password_confirmation')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Redefinir senha</button>
        </form>

        <div class="auth-footer">
            <p><a href="{{ route('login') }}">Voltar para login</a></p>
        </div>
    </div>
</div>
@endsection
