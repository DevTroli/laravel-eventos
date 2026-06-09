<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Copa 2026')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="container header-container">
        <a href="/" class="logo">
            <span class="logo-text">COPA</span>
            <span class="logo-year">2026</span>
        </a>

        <nav class="nav-desktop">
            <a href="/" class="nav-link">Início</a>
            <a href="{{ route('ingressos.index') }}" class="nav-link">Ingressos</a>
            <a href="{{ route('sobre') }}" class="nav-link">Quem Somos</a>
            <a href="{{ route('contato') }}" class="nav-link">Contato</a>
        </nav>

 <div class="header-actions">
 @auth
 <div class="header-user">
 <span class="header-username">{{ auth()->user()->name }}</span>
 @if(auth()->user()->isAdmin())
 <a href="{{ route('admin.dashboard') }}" class="btn-sm btn-login">Admin</a>
 @else
 <a href="{{ route('pedidos.index') }}" class="btn-sm btn-login">Meus Pedidos</a>
 @endif
 <form action="{{ route('logout') }}" method="POST" class="header-logout">
 @csrf
 <button type="submit" class="btn-sm btn-outline">Sair</button>
 </form>
 </div>
 @else
 <a href="{{ route('login') }}" class="btn-sm btn-login header-login-btn">Entrar</a>
 @endauth

 <a href="{{ route('carrinho.index') }}" class="header-cart">
 <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
 <circle cx="9" cy="21" r="1"></circle>
 <circle cx="20" cy="21" r="1"></circle>
 <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
 </svg>
 @if(session('carrinho') && count(session('carrinho')) > 0)
 <span class="cart-badge">
 {{ count(session('carrinho')) }}
 </span>
 @endif
 </a>

 <button class="hamburger" onclick="toggleMobileMenu()">
 <span></span>
 <span></span>
 <span></span>
 </button>
 </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="/" class="mobile-nav-link">Início</a>
        <a href="{{ route('ingressos.index') }}" class="mobile-nav-link">Ingressos</a>
        <a href="{{ route('sobre') }}" class="mobile-nav-link">Quem Somos</a>
        <a href="{{ route('contato') }}" class="mobile-nav-link">Contato</a>
        @auth
        <div class="mobile-user-info">
            {{ auth()->user()->name }}
        </div>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link">Admin</a>
        @else
        <a href="{{ route('pedidos.index') }}" class="mobile-nav-link">Meus Pedidos</a>
        @endif
        <form action="{{ route('logout') }}" method="POST" class="mobile-logout-form">
            @csrf
            <button type="submit" class="btn-outline mobile-btn-full">Sair</button>
        </form>
        @else
        <a href="{{ route('register') }}" class="mobile-nav-link">Criar Conta</a>
        <a href="{{ route('login') }}" class="mobile-nav-link">Entrar</a>
        @endauth
        <a href="{{ route('carrinho.index') }}" class="mobile-nav-link mobile-cart-link">
            🛒 Carrinho
            @if(session('carrinho') && count(session('carrinho')) > 0)
            <span class="mobile-cart-badge">
                {{ count(session('carrinho')) }}
            </span>
            @endif
        </a>
    </div>
</header>

<main class="main-content">
    @yield('conteudo')
</main>

<footer class="footer">
    <div class="container footer-grid">
        <div class="footer-section">
            <div class="footer-logo">
                <span class="logo-text">COPA</span>
                <span class="logo-year">2026</span>
            </div>
            <p class="footer-desc">Seu portal oficial de ingressos para a Copa do Mundo FIFA 2026. vivencie emoções únicas!</p>
            <div class="social-links">
                <a href="#" class="social-link" title="Instagram">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="#" class="social-link" title="Facebook">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>
                <a href="#" class="social-link" title="Twitter">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                    </svg>
                </a>
                <a href="#" class="social-link" title="YouTube">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                    </svg>
                </a>
            </div>
        </div>
        <div class="footer-section">
            <h4>Links Rápidos</h4>
            <ul class="footer-links">
                <li><a href="/">Início</a></li>
                <li><a href="{{ route('ingressos.index') }}">Comprar Ingressos</a></li>
                <li><a href="{{ route('sobre') }}">Quem Somos</a></li>
                <li><a href="{{ route('contato') }}">Contato</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Atendimento</h4>
            <ul class="footer-links">
                <li>Segunda a Sexta: 8h às 18h</li>
                <li>Sábado: 9h às 13h</li>
                <li><a href="mailto:contato@copa2026.com">contato@copa2026.com</a></li>
                <li><a href="tel:+551140028922">(11) 4002-8922</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Endereço</h4>
            <address class="footer-address">
                Av. das Nações, 1500<br>
                São Paulo - SP<br>
                CEP 01310-100
            </address>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; {{ date('Y') }} Copa do Mundo FIFA 2026. Todos os direitos reservados.</p>
            <p class="footer-disclaimer">Projeto desenvolvido para fins educacionais.</p>
        </div>
    </div>
</footer>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('active');
    }
</script>
</body>
</html>
