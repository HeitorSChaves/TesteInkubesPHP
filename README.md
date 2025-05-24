# TesteInkubesPHP

## Requisitos
- PHP 8.2 ou superior
- MySQL 5.7+
- Composer
- XAMPP, WAMP, Laragon ou outro ambiente local com Apache/MySQL

## Estrutura do Projeto
- MVC simples (Model, View, Controller)
- Diretórios principais:
  - `app/Controllers` - Lógica dos controllers
  - `app/Models` - Models (acesso ao banco)
  - `app/Views` - Views (HTML, JS, AJAX)
  - `app/Core` - Classes base do framework
  - `public/` - Pasta pública para acesso via navegador
  - `config/` - Configurações do projeto
  - `database.sql` - Script para criar as tabelas necessárias

## Como rodar o projeto localmente

1. Clone o repositório:
   ```
   git clone <url-do-repositorio>
   ```
2. Importe o arquivo `database.sql` no seu MySQL (phpMyAdmin, DBeaver, etc):
   ```
   # No terminal MySQL ou phpMyAdmin
   source /caminho/para/database.sql;
   ```
3. Configure o banco em `config/config.php` se necessário (usuário, senha, nome do banco).
4. Inicie o Apache/MySQL pelo XAMPP ou similar.
5. Acesse no navegador:
   ```
   http://localhost/testePhP/TesteInkubesPHP/public
   ```

## Como criar as tabelas necessárias

Basta rodar o script `database.sql` incluso no projeto. Ele cria as tabelas `users` e `tasks` com as colunas corretas para funcionamento do sistema.

## Observações de Segurança
- Todas as operações usam prepared statements (PDO) para evitar SQL Injection.
- Todos os dados exibidos são escapados com `htmlspecialchars` para evitar XSS.
- Há validação de dados no backend e frontend.

---

Dúvidas? Abra uma issue ou entre em contato.