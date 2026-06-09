@extends('template')

@section('titulo', 'Criar Conta - Copa 2026')

@section('conteudo')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Criar conta</h1>
            <p class="auth-subtitle">Cadastre-se para comprar ingressos da Copa 2026</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <div class="form-field">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Seu nome completo">
                @error('name')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="seu@email.com">
                @error('email')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                @error('password')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <label for="password_confirmation">Confirmar senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Repita a senha">
                @error('password_confirmation')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Criar conta</button>
        </form>

        <div class="auth-footer">
            <p>Já tem conta? <a href="{{ route('login') }}">Entrar</a></p>
        </div>
    </div>
</div>
@endsection
