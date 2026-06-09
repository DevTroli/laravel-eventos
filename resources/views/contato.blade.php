@extends('template')

@section('titulo', 'Contato - Copa 2026')

@section('conteudo')
<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1>Fale Conosco</h1>
        <p>Estamos aqui para te atender</p>
    </div>
</div>

<!-- Contact Section -->
<div class="container" style="padding: 4rem 1.5rem;">
    <div class="contact-grid">
        <!-- Contact Info -->
        <div class="contact-info">
            <h2>Informações de Contato</h2>
            <p style="color: var(--text-secondary); margin-bottom: 2rem;">
                Entre em conosco através dos canais abaixo. Nosso time de atendimento
                está disponível para te ajudar com qualquer dúvida sobre ingressos,
                pagamentos ou informações sobre os jogos.
            </p>

            <div class="contact-item">
                <div class="contact-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <div class="contact-details">
                    <h4>Endereço</h4>
                    <p>Av. das Nações, 1500<br>São Paulo - SP, CEP 01310-100</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <div class="contact-details">
                    <h4>Telefone</h4>
                    <p><a href="tel:+551140028922">(11) 4002-8922</a></p>
                    <p><a href="tel:+5511999998888">(11) 99999-8888</a> (WhatsApp)</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div class="contact-details">
                    <h4>E-mail</h4>
                    <p><a href="mailto:contato@copa2026.com">contato@copa2026.com</a></p>
                    <p><a href="mailto:suporte@copa2026.com">suporte@copa2026.com</a></p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="contact-details">
                    <h4>Horário de Atendimento</h4>
                    <p>Segunda a Sexta: 8h às 18h</p>
                    <p>Sábado: 9h às 13h</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="form-container" style="margin: 0;">
            <h2 class="form-title">Envie uma Mensagem</h2>
            <p class="form-subtitle">Preencha o formulário abaixo e retornaremos em até 24 horas.</p>

            <form>
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="text" id="assunto" name="assunto" placeholder="Motivo do contato">
                </div>

                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" rows="5" placeholder="Como podemos te ajudar?" required style="width: 100%; padding: 0.875rem 1rem; border: 1px solid var(--border); border-radius: 10px; font-size: 1rem; font-family: inherit; resize: vertical;"></textarea>
                </div>

                <button type="submit" class="btn-submit" style="width: 100%; margin-left: 0;">
                    Enviar Mensagem
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; vertical-align: middle; margin-left: 0.5rem;">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection