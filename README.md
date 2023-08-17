# README - Projeto DocGen

O DocGen é um projeto de clone que tem como objetivo facilitar a documentação de APIs. Ele fornece uma interface intuitiva para criar, visualizar e gerenciar documentações de APIs de forma simples e eficiente.

## Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas em seu sistema:

- Docker
- Docker Compose
- Composer
- Git
- PHP >= 8.1
- Node.js >= 16.0
- NPM

## Configuração inicial

1. Clone o repositório do projeto:
   ```
   git clone https://github.com/henriquernandes/docgen.git
   ```

2. Acesse a pasta "back"
   ```
   cd back
   ```

3. Ainda na pasta "back" execute o seguinte comando para instalar as dependências do Composer:
   ```
   composer install
   ```

4. Ainda na pasta "back" do projeto copie arquivo `.env.example` para `.env`
   ```
   cp .env.example .env
   ```

5. Execute as migrações do banco de dados com o comando:
   ```
   ./vendor/bin/sail up -d
   ```

6. Se quiser pode configurar um atalho para executar o sail em vez de executar `./vendor/bin/sail` você executará apenas `sail` (execute o comando no terminal):
   ```
   alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
   ```

7. Execute as migrações do banco de dados com o comando:
   ```
   ./vendor/bin/sail artisan migrate
   ```

8. Execute os seeders para popular o banco de dados com dados iniciais:
   ```
   ./vendor/bin/sail artisan db:seed
   ```

## Executando o frontend

1. Saia da pasta "back"
   ```
   cd ..
   ```
2. Entre na pasta "front"
   ```
   cd front
   ```

3. execute o seguinte comando para instalar as dependências do Node.js:
   ```
   npm install
   ```

4. Ainda na pasta "front" do projeto copie arquivo `.env.example` para `.env`
   ```
   cp .env.example .env
   ```

5. Compile os assets e inicie o servidor de desenvolvimento com o seguinte comando:
   ```
   npm run dev
   ```

## Acessando o projeto

Após seguir todos os passos acima, você pode acessar o projeto no navegador através do endereço `localhost:3000`.

## Credenciais de acesso

Utilize as seguintes credenciais para fazer login no sistema:

- E-mail: docgen@docgen.com
- Senha: docgen

Certifique-se de usar essas informações para acessar as funcionalidades do projeto.
