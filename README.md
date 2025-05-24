
# 📍 Projeto Ponto Eletrônico

Sistema web de ponto eletrônico desenvolvido com Laravel, voltado para o controle de registros de entrada e saída de funcionários.

---

## 🚀 Tecnologias Utilizadas

- **PHP 8.4.5**
- **Laravel 10**
- **Composer 2.8.6**
- **MySQL (InnoDB)**
- **Bootstrap 5**
- **API ViaCEP** (busca automática de endereço via CEP)

---

## ⚙️ Como Subir o Projeto Localmente

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd ponto-eletronico
   ```

2. **Configure o ambiente:**
   ```bash
   cp .env.example .env
   # edite o .env com as credenciais do seu banco de dados
   ```

3. **Instale as dependências PHP:**
   ```bash
   composer install
   ```

4. **Compile os assets front-end:**
   ```bash
   npm install && npm run dev
   ```

5. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

6. **Execute as migrations:**
   ```bash
   php artisan migrate
   ```

7. **Inicie o servidor local:**
   ```bash
   php artisan serve
   ```

8. **Acesse no navegador:**
   ```
   http://localhost:8000
   ```

---

## 👤 Acesso Inicial

> Criação automática de usuários via seed ou manualmente via painel administrativo.

**Admin Padrão:**
## Criar Usuário Administrador

Para criar o primeiro usuário administrador no sistema, você pode utilizar o Tinker do Laravel:

```bash
php artisan tinker


\App\Models\User::create([
    'name' => 'Administrador',
    'email' => 'admin@teste.com',
    'password' => bcrypt('12345678'),
    'is_admin' => true // Ajuste conforme seu modelo de permissões
]);


\App\Models\User::factory()->create([
    'name' => 'Administrador',
    'email' => 'admin@teste.com',
    'password' => bcrypt('12345678'),
    'is_admin' => true,
]);

```bash
php artisan db:seed

**Funcionários** podem ser cadastrados após login com perfil admin.

---

## 📊 Funcionalidades

### 👨‍💼 Admin
- Gerenciamento de usuários
- Consulta e filtro de registros de ponto
- Geração de relatórios (inclusive com SQL puro)

### 👷 Funcionário
- Registro de entrada/saída (ponto)
- Alteração de senha

---

## 🧪 Testes

Para rodar os testes unitários:

```bash
php artisan test
```

---

## 📄 Relatórios SQL

- O relatório de pontos está disponível para administradores com um botão de exportação SQL direto da interface.

---

## ✅ Contribuições

Sinta-se à vontade para abrir issues ou enviar PRs!

---

Desenvolvido com 💻 por [Seu Nome ou Time].
