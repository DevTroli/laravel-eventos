# 🏆 Copa do Mundo FIFA 2026 - Sistema de Ingressos

Sistema web de gerenciamento de ingressos para a Copa do Mundo 2026, desenvolvido em **Laravel 12** com PHP 8.2+.

Este projeto é um exemplo educacional de CRUD completo, demonstrando as principais funcionalidades do Laravel de forma simples e direta.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)
![License](https://img.shields.io/badge/license-MIT-green)

---

## 📋 Funcionalidades

- ✅ **Listar ingressos** - Visualiza todos os ingressos disponíveis
- ✅ **Cadastrar ingressos** - Adiciona novos ingressos com validação
- ✅ **Editar ingressos** - Atualiza informações de ingressos existentes
- ✅ **Excluir ingressos** - Remove ingressos do sistema
- ✅ **Página inicial** - Mostra ingressos em destaque
- ✅ **Validação de formulários** - Garante integridade dos dados
- ✅ **Seeder com dados de exemplo** - Popula o banco automaticamente

---

## 🚀 Requisitos

Antes de começar, verifique se você tem instalado:

- **PHP 8.2** ou superior
- **Composer** (gerenciador de dependências do PHP)
- **Node.js 18+** e **npm** (para assets frontend)
- **SQLite** (já incluso no PHP, mas pode usar MySQL/PostgreSQL)

### Verificando as instalações

```bash
php -v          # Deve mostrar PHP 8.2+
composer -V     # Deve mostrar Composer 2.x
node -v         # Deve mostrar Node 18+
npm -v          # Deve mostrar npm 8+
```

---

## 📦 Instalação Passo a Passo

### 1. Clone o repositório

```bash
git clone <URL_DO_SEU_REPOSITORIO>
cd laravel-app
```

### 2. Instale as dependências do PHP

```bash
composer install
```

### 3. Configure o ambiente

Copie o arquivo de exemplo e gere a chave da aplicação:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure o banco de dados

O projeto usa **SQLite por padrão**. Para configurar:

**Opção A - SQLite (recomendado para desenvolvimento):**

Crie o arquivo do banco:
```bash
touch database/database.sqlite
```

No arquivo `.env`, certifique-se de que está configurado:
```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD # podem ficar vazios
```

**Opção B - MySQL:**

No `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ingressos_copa2026
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

### 5. Rode as migrations e seeders

```bash
php artisan migrate --seed
```

Isso vai:
- Criar a tabela `ingressos` no banco de dados
- Popular com 8 ingressos de exemplo da Copa 2026

### 6. Instale e compile os assets frontend

```bash
npm install
npm run build
```

---

## ▶️ Rodando o Projeto

### Opção 1: Servidor de desenvolvimento simples

```bash
php artisan serve
```

Acesse: **http://localhost:8000**

### Opção 2: Todos os serviços juntos (recomendado)

```bash
composer run dev
```

Este comando roda simultaneamente:
- Servidor web (http://localhost:8000)
- Queue worker
- Logs em tempo real
- Vite (frontend com HMR em http://localhost:5173)

---

## 🎯 Como Usar

### Página Inicial
- Acesse **http://localhost:8000**
- Visualize ingressos em destaque e todos os cadastrados

### Gerenciar Ingressos
1. Clique em **"Ingressos"** no menu ou acesse **http://localhost:8000/ingressos**
2. Use **"+ Novo Ingresso"** para criar um ingresso
3. Clique em **"Editar"** para modificar um ingresso existente
4. Use **"Excluir"** para remover um ingresso

### Estrutura dos Ingressos

| Campo | Descrição | Exemplo |
|-------|-----------|---------|
| **Jogo** | Nome das equipes e fase | "Brasil vs Argentina - Quartas de Final" |
| **Setor** | Área do estádio | "Arquibancada Norte", "Camarotes VIP" |
| **Preço** | Valor do ingresso | 350.00 |
| **Quantidade** | Ingressos disponíveis | 250 |

---

## 🧪 Testes

Para rodar a suíte de testes:

```bash
composer run test
```

Para rodar um teste específico:

```bash
php artisan test --filter=ExemploTest
```

---

## 📁 Estrutura do Projeto

```
laravel-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── AppController.php    # Controlador principal (CRUD)
│   └── Models/
│       └── Ingresso.php             # Model de Ingresso
├── database/
│   ├── factories/
│   │   └── IngressoFactory.php      # Factory para testes
│   ├── migrations/
│   │   └── 2026_05_19_192309_create_ingressos_table.php
│   └── seeders/
│       └── DatabaseSeeder.php       # Popula com dados de exemplo
├── resources/
│   └── views/
│       ├── template.blade.php       # Layout base
│       ├── welcome.blade.php        # Página inicial
│       ├── ingressos.blade.php      # Lista de ingressos
│       ├── ingressos-create.blade.php
│       └── ingressos-edit.blade.php
├── routes/
│   └── web.php                      # Rotas da aplicação
├── public/
│   └── css/
│       └── style.css                # Estilos personalizados
├── .env                             # Configurações ambiente (não commitar!)
├── .env.example                     # Exemplo de configuração
└── README.md                        # Este arquivo
```

---

## 🛠️ Comandos Úteis

### Desenvolvimento

```bash
# Instalar tudo do zero
composer install && npm install && cp .env.example .env && php artisan key:generate && php artisan migrate --seed && npm run build

# Rodar servidor
php artisan serve

# Desenvolvimento frontend com recarregamento automático
npm run dev

# Build para produção
npm run build
```

### Banco de Dados

```bash
# Rodar migrations
php artisan migrate

# Recriar banco do zero (CUIDADO: apaga tudo!)
php artisan migrate:fresh --seed

# Listar tables
php artisan db:show
```

### Código e Qualidade

```bash
# Verificar código com Laravel Pint
vendor/bin/pint --test

# Corrigir automaticamente
vendor/bin/pint

# Listar rotas
php artisan route:list
```

### Limpeza

```bash
# Limpar caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ou tudo junto
php artisan optimize:clear
```

---

## 🔧 Troubleshooting

### Erro: "No application encryption key has been generated"

```bash
php artisan key:generate
```

### Erro: "Database does not exist" (MySQL)

Crie o banco manualmente:
```sql
CREATE DATABASE ingressos_copa2026 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Ou use SQLite:
```bash
touch database/database.sqlite
```

### Erro: "Class 'AppModels\Ingresso' not found"

Execute:
```bash
composer dump-autoload
```

### Erro: "Vite manifest not found"

```bash
npm run build
```

### Página em branco / erro 500

Verifique os logs:
```bash
tail -f storage/logs/laravel.log
```

Ou use:
```bash
php artisan pail
```

---

## 📚 Tecnologias Utilizadas

| Tecnologia | Versão | Finalidade |
|------------|--------|------------|
| Laravel | 12 | Framework PHP |
| PHP | 8.2+ | Linguagem backend |
| Blade | - | Template engine |
| Vite | 5.x | Build de frontend |
| SQLite | 3 | Banco de dados |
| CSS Personalizado | - | Estilização tema Copa 2026 |

---

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/minha-feature`)
3. Commit suas mudanças (`git commit -m 'feat: Minha feature'`)
4. Push para a branch (`git push origin feature/minha-feature`)
5. Abra um Pull Request

---

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 👨‍💻 Desenvolvedor

Desenvolvido como projeto educacional para demonstrar Laravel 12.

**Tecnologias-chave aprendidas:**
- MVC no Laravel
- Eloquent ORM
- Blade Templates
- Validação de formulários
- Migrations e Seeders
- Rotas e Controllers

---

## 🎯 Próximos Passos (Sugestões de Estudo)

Quer evoluir este projeto? Tente implementar:

1. **Autenticação** - Login de usuários
2. **Carrinho de compras** - Simular compra de ingressos
3. **Upload de imagens** - Foto do estádio/jogo
4. **Paginação** - `Ingresso::paginate(10)`
5. **Filtros** - Por jogo, setor, faixa de preço
6. **API REST** - `php artisan make:api`
7. **Testes automatizados** - Feature tests para o CRUD

---

## 📞 Suporte

Para dúvidas sobre Laravel:
- [Documentação Oficial](https://laravel.com/docs)
- [Laracasts](https://laracasts.com)
- [Comunidade Laravel Brasil (Discord)](https://discord.gg/laravel)