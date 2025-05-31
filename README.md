# 📚 Sistema de Gestão de Livros

Sistema Laravel para gestão de livros e autores. Inclui interface web, API REST com autenticação, upload de imagens, middleware de segurança e sistema de agendamento de tarefas.

## 🚀 Funcionalidades Principais

- ✅ **CRUD** de livros e autores com interface Blade responsiva
- ✅ **Upload de capas** com redimensionamento automático (200x200px)
- ✅ **API REST** com autenticação Laravel Sanctum
- ✅ **Sistema de autenticação** com controle de permissões (admin/usuário)
- ✅ **Middleware de segurança** para proteção de rotas administrativas
- ✅ **Scheduler** para limpeza automática de logs antigos
- ✅ **Relacionamentos** entre livros e autores
- ✅ **Validação** de formulários e uploads

## 🛠️ Tecnologias

- **PHP:** 8.3+
- **Framework:** Laravel 12.15
- **Frontend:** Blade Templates + Bootstrap 5
- **Banco de Dados:** MySQL 8.0+
- **Autenticação API:** Laravel Sanctum
- **Processamento de Imagens:** Intervention Image 3.11
- **Testes:** Pest 3.8

## 📦 Instalação e Configuração

### 1. Pré-requisitos

- PHP >= 8.3
- MySQL >= 8.0
- Composer
- Node.js (opcional, para assets)
- Extensões PHP: GD, mbstring, xml, curl, zip, mysql, sqlite3 (para testes)

### 2. Instalação das Extensões PHP

```bash
# Extensões PHP necessárias para o projeto
sudo apt update
sudo apt install -y php8.3-gd php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-mysql php8.3-sqlite3
```

### 3. Instalação

```bash
# Clonar o repositório
git clone <repository-url>
cd book-manager

# Instalar dependências
composer install

# Configurar ambiente
cp .env.example .env
php artisan key:generate
```

### 4. Configurar Banco de Dados

Execute o script de configuração do banco de dados disponível na raiz do projeto:

```bash
# Tornar o script executável
chmod +x setup-database.sh

# Executar o script para criar o banco de dados e o usuário automaticamente
./setup-database.sh
```

O script irá configurar um banco MySQL com as seguintes credenciais:

- **Database:** book_manager
- **Username:** laravel
- **Password:** laravel123

Estas credenciais já estão configuradas no arquivo `.env` por padrão.

### 5. Inicializar o Sistema

```bash
# Executar migrações e popular dados
php artisan migrate --seed

# Criar link simbólico para storage
php artisan storage:link

# Iniciar servidor de desenvolvimento
php artisan serve
```

Acesse: `http://localhost:8000`

## 👤 Usuários de Teste

- **Administrador:** admin@test.com / password
- **Usuário:** user@test.com / password

## 🌍 Principais Rotas

### Sistema Web

- `/` - Página inicial
- `/login` - Login do sistema
- `/books` - Gestão de livros (requer admin)
- `/authors` - Gestão de autores (requer admin)

### API REST

- `POST /api/auth/login` - Autenticação
- `GET /api/authors` - Listar autores
- `GET /api/authors/{id}/books` - Livros do autor
- **Headers:** `Authorization: Bearer {token}`

## 🗄️ Estrutura do Banco

```sql
-- Autores
authors: id, nome, estado, timestamps

-- Livros
books: id, titulo, descricao, data_publicacao, author_id, capa, timestamps

-- Usuários
users: id, name, email, password, role, timestamps

-- Logs (para scheduler)
logs: id, level, message, context, channel, timestamps
```

## ⚙️ Comandos Úteis

```bash
# Executar testes
./vendor/bin/pest

# Limpar logs manualmente
php artisan logs:clean-old

# Verificar scheduler
php artisan schedule:list

# Rodar migrações fresh (cuidado: apaga dados!)
php artisan migrate:fresh --seed

# Verificar extensões PHP instaladas
php -m | grep -E 'gd|mbstring|xml|curl|zip|mysql|sqlite'
```

## 🧪 Testes de Verificação

O sistema inclui testes automatizados para validar funcionalidades. Para executar os testes, você precisa ter a extensão SQLite3 do PHP instalada:

```bash
# Verifique se a extensão SQLite está instalada
php -m | grep sqlite

# Se não estiver instalada, instale-a
sudo apt install -y php8.3-sqlite3

# Executar todos os testes
./vendor/bin/pest

# Testes específicos
./vendor/bin/pest tests/Feature/SystemHealthTest.php
```

## 📄 Documentação Adicional

- **[API Documentation](API_DOCUMENTATION.md)** - Referência completa da API
- **[Web Documentation](WEB_DOCUMENTATION.md)** - Guia do sistema web

---

**Desenvolvido por Lucas Rodrigues**
