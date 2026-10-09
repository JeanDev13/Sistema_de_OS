-- CRIAÇÃO BANCO DE DADOS
CREATE DATABASE IF NOT EXISTS ordem_servico
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE ordem_servico;

--TABELA CLIENTES
CREATE TABLE clientes (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
cpf VARCHAR(14) NOT NULL,
telefone VARCHAR(20) NOT NULL,
email VARCHAR(100),
endereco VARCHAR(200)
);

--TABELA EQUIPAMENTOS 
CREATE TABLE equipamentos (
id INT AUTO_INCREMENT PRIMARY KEY,
cliente_id INT NOT NULL,
tipo VARCHAR(50) NOT NULL,
marca VARCHAR(50) NOT NULL,
modelo VARCHAR(100) NOT NULL,
numero_serie VARCHAR(100),

```
FOREIGN KEY (cliente_id) REFERENCES clientes(id)
```

);

-- TABELA SERVICOS
CREATE TABLE servicos (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
descricao TEXT,
preco DECIMAL(10,2) NOT NULL
);

--TABELA PEÇAS 
CREATE TABLE pecas (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
descricao TEXT,
preco DECIMAL(10,2) NOT NULL,
estoque INT NOT NULL DEFAULT 0
);

-- TABELA DE OS
CREATE TABLE ordens_servico (
id INT AUTO_INCREMENT PRIMARY KEY,
equipamento_id INT NOT NULL,
descricao_problema TEXT NOT NULL,
diagnostico TEXT,
status ENUM(
'Aberta',
'Em análise',
'Aguardando aprovação',
'Em andamento',
'Concluída',
'Entregue',
'Cancelada'
) NOT NULL DEFAULT 'Aberta',
valor_total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
data_abertura DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
data_conclusao DATETIME,

```
FOREIGN KEY (equipamento_id)
    REFERENCES equipamentos(id)
```

);

-- TABELA RELACIONADA ENTRE OS E SERVIÇOS
CREATE TABLE os_servicos (
id INT AUTO_INCREMENT PRIMARY KEY,
ordem_servico_id INT NOT NULL,
servico_id INT NOT NULL,
quantidade INT NOT NULL DEFAULT 1,
preco_unitario DECIMAL(10,2) NOT NULL,

```
FOREIGN KEY (ordem_servico_id)
    REFERENCES ordens_servico(id),

FOREIGN KEY (servico_id)
    REFERENCES servicos(id)
```

);

-- TABELA RELACIONADA ENTRE OS E PEÇAS
CREATE TABLE os_pecas (
id INT AUTO_INCREMENT PRIMARY KEY,
ordem_servico_id INT NOT NULL,
peca_id INT NOT NULL,
quantidade INT NOT NULL DEFAULT 1,
preco_unitario DECIMAL(10,2) NOT NULL,

```
FOREIGN KEY (ordem_servico_id)
    REFERENCES ordens_servico(id),

FOREIGN KEY (peca_id)
    REFERENCES pecas(id)
```

);
