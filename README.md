
---

# BOOK WISE
![Screenshot do Sistema](./public/images/boo-wise.png)
> Sistema para postagem de livros e avaliar os seus livros preferidos.

---

## Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Instalação](#instalação)
- [Como Usar](#como-usar)
- [Estrutura de Arquivos](#estrutura-de-arquivos)

---

## Sobre o Projeto

> Este projeto foi desenvolvido para estudar php sem uso de algum frameworks, construir rodas, controllers e models 
> explorando o padrão de projeto MVC.

---

## Funcionalidades

- Registro de novos usuários
- Login do usuário 
- Cadastro de livros
- Visualização de livros
- Fazer avaliações do livros 
- Só pode registra um livro se fizer o login

---

## Tecnologias Utilizadas

- PHP (versão 8.2.25)
- SQLite
- Tailwind
- SQL

---

## Instalação

**Pré-requisitos:**
- PHP 8.2 ou superior
- Qualquer banco de dados

**Passos de instalação:**

1. Clone o repositório:
   ```bash
   git clone https://github.com/PedroSantiagoDev/book-wise.git
   ```
2. Entre na pasta do projeto:
   ```bash
   cd book-wise
   ```
3. Mudar as config para acessar o banco de dados escolhido:
   ```php
   // Configuração para usar o sqlite
   return [
            'database' => [
                'driver' => 'sqlite',
                'database' => '../database.sqlite'
            ]
        ];
   ```

4. Executar o sql para criação das tabelas.
    ```sql
    CREATE TABLE avaliacoes (
        id integer primary key,
        usuario_id integer,
        livro_id integer,
        avaliacao text,
        nota integer,
        foreign key(usuario_id) references usuarios(id) on delete cascade,
        foreign key(livro_id) references livros(id) on delete cascade
    );

    CREATE TABLE livros (
        id integer primary key,
        titulo varchar(255),
        autor vachar(100),
        descricao text,
        ano_de_lancamento integer,
        usuario_id integer, imagem varchar(100),
        foreign key(usuario_id) references usuarios(id) on delete cascade
    );

    CREATE TABLE usuarios(
        id integer primary key,
        nome varchar(255) not null,
        email varchar(200) not null,
        senha varchar(100) not null
    );
    ```

---

## Como Usar

Abrir o terminal e roda o comando usando o servido embutido do php
```bash
 php -S localhost:8080 -d auto_append_file=server.php -t public
```

---

## Estrutura de Arquivos

Descreva a organização de pastas e arquivos principais para ajudar o usuário a navegar pelo projeto.

**Exemplo:**
```
├── controllers/         # Controladores para a lógica principal do sistema
├── models/              # Modelos que representam e manipulam os dados
├── public/              # Arquivo onde passar todas as nossas requisições
├── views/               # Templates de visualização
├── config.php           # Configurações principais do projeto
├── Database.php         # Conexão com o banco de dados
├── Flash.php            # Mensagens temporárias entre requisições
├── functions.php        # Funções auxiliares do sistema
├── README.md            # Documentação do projeto
├── routes.php           # Definição de rotas do sistema
└── Validacao.php        # Validação de dados de entrada        
```
