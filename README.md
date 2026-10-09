# Sistema de Ordem de Serviço

Sistema web para gerenciamento de ordens de serviço, desenvolvido com PHP, MySQL, PDO, HTML, CSS e JavaScript.

O projeto tem como objetivo simular um sistema utilizado por empresas de assistência técnica para controlar clientes, equipamentos, serviços e ordens de serviço.

## Tecnologias utilizadas

- PHP
- MySQL
- PDO
- HTML5
- CSS3
- JavaScript
- Git
- GitHub

## Funcionalidades

### Clientes
- Cadastro de clientes
- Listagem de clientes
- Edição de clientes
- Exclusão de clientes
- Pesquisa de clientes
- Histórico de ordens de serviço

### Equipamentos
- Cadastro de equipamentos
- Associação do equipamento a um cliente
- Informações de marca e modelo
- Número de série
- Descrição do problema

### Ordens de Serviço
- Abertura de ordens de serviço
- Associação com clientes e equipamentos
- Registro do problema informado
- Diagnóstico
- Serviços realizados
- Peças utilizadas
- Controle de valores
- Alteração de status
- Histórico de ordens

### Dashboard
- Total de ordens de serviço
- Ordens abertas
- Ordens em andamento
- Ordens concluídas
- Valores dos serviços

### JavaScript
- Validações de formulários
- Confirmações de ações
- Cálculos automáticos
- Filtros e pesquisas
- Interações dinâmicas da interface

## Status do projeto

Em desenvolvimento

O sistema está sendo desenvolvido por etapas, desde a estrutura do banco de dados até a implementação das funcionalidades e interface.

## Estrutura do projeto

```text
ordem-servico/
│
├── config/
│   └── conexao.php
│
├── clientes/
│   ├── index.php
│   ├── cadastrar.php
│   ├── editar.php
│   └── excluir.php
│
├── equipamentos/
│   ├── index.php
│   ├── cadastrar.php
│   ├── editar.php
│   └── excluir.php
│
├── os/
│   ├── index.php
│   ├── cadastrar.php
│   ├── visualizar.php
│   ├── editar.php
│   └── excluir.php
│
├── css/
│   └── style.css
│
├── js/
│   └── script.js
│
├── index.php
└── README.md
└── shema.sql
