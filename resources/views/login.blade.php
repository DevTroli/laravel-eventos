@extends('template')

@section('titulo', 'Login - Copa 2026')

@section('conteudo')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>Bem-vindo de Volta!</h1>
            <p>Faça login para acessar sua conta</p>
        </div>

        <form>
            <div class="login-input">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="login-input">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
            </div>

            <div style="text-align: right; margin-bottom: 1.5rem;">
                <a href="#" style="color: var(--accent); text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                    Esqueceu a senha?
                </a>
            </div>

            <button type="submit" class="login-btn">Entrar</button>
        </form>

        <div class="login-footer">
            <p>Não tem uma conta? <a href="#">Cadastre-se</a></p>
        </div>
    </div>
</div>
@endsection