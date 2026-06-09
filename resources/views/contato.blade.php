@extends('template')

@section('titulo', 'Contato - Copa 2026')

@section('conteudo')
<section class="section">
    <div class="container">
        <div class="contact-header">
            <h1 class="contact-title">Fale Conosco</h1>
            <p class="contact-subtitle">Dúvidas sobre ingressos, pedidos ou o evento? Nossa equipe está pronta para ajudar.</p>
        </div>

        <div class="contact-wrapper">
            <div class="contact-info">
                <div class="contact-item">
                    <h2>Atendimento Telefônico</h2>
                    <p class="contact-detail">
                        <a href="tel:+551140028922">(11) 4002-8922</a>
                    </p>
                    <p class="contact-hours">Segunda a Sexta, das 8h às 18h (horário de Brasília)</p>
                </div>

                <div class="contact-item">
                    <h2>Email</h2>
                    <p class="contact-detail">
                        <a href="mailto:contato@copa2026.com">contato@copa2026.com</a>
                    </p>
                    <p class="contact-hours">Respondemos em até 24 horas úteis</p>
                </div>

                <div class="contact-item">
                    <h2>Escritório</h2>
                    <address class="contact-detail">
                        Av. das Nações, 1500<br>
                        São Paulo - SP<br>
                        CEP 01310-100
                    </address>
                </div>

                <div class="contact-note">
                    <p><strong>Importante:</strong> Para consultas sobre pedidos já realizados, tenha em mãos o número do seu pedido para agilizar o atendimento.</p>
                </div>
            </div>

            <div class="contact-form-container">
                <h2>Envie uma Mensagem</h2>
                <form class="simple-contact-form" method="POST" action="#">
                    @csrf
                    <div class="form-field">
                        <label for="nome">Nome completo</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-field">
                        <label for="assunto">Assunto</label>
                        <select id="assunto" name="assunto" required>
                            <option value="">Selecione...</option>
                            <option value="ingresso">Dúvida sobre ingressos</option>
                            <option value="pedido">Consulta sobre pedido</option>
                            <option value="pagamento">Pagamento</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="mensagem">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.contact-header {
    text-align: center;
    max-width: 600px;
    margin: 0 auto 3rem;
    padding-top: 2rem;
}

.contact-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 0.75rem 0;
}

.contact-subtitle {
    font-size: 1.0625rem;
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.contact-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    max-width: 1000px;
    margin: 0 auto;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-item h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.contact-detail {
    font-size: 1.125rem;
    color: var(--text-light);
    margin: 0;
}

.contact-detail a {
    color: var(--primary);
    text-decoration: none;
}

.contact-hours {
    font-size: 0.875rem;
    color: var(--text-light);
    margin: 0.25rem 0 0 0;
}

.contact-note {
    background: rgba(99, 102, 241, 0.05);
    border: 1px solid rgba(99, 102, 241, 0.15);
    border-radius: 8px;
    padding: 1rem 1.25rem;
    margin-top: 1rem;
}

.contact-note p {
    font-size: 0.875rem;
    color: var(--text);
    margin: 0;
}

.contact-form-container {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 2rem;
    height: fit-content;
}

.contact-form-container h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 1.5rem 0;
}

.form-field {
    margin-bottom: 1.25rem;
}

.form-field label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text);
    margin-bottom: 0.5rem;
}

.form-field input,
.form-field select,
.form-field textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.2s;
}

.form-field input:focus,
.form-field select:focus,
.form-field textarea:focus {
    outline: none;
    border-color: var(--primary);
}

.form-field textarea {
    resize: vertical;
}

.btn-submit {
    width: 100%;
    padding: 0.875rem 1.5rem;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-submit:hover {
    background: var(--primary-dark);
}

@media (max-width: 900px) {
    .contact-wrapper {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
}
</style>
@endsection