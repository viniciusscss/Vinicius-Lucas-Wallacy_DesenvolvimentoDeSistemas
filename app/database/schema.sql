-- database/schema.sql

-- Tabela para Usuários (do sistema de autenticação existente, caso ainda não exista)
-- Se esta tabela já foi criada de outra forma, você pode remover este bloco.
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Tabela para Clientes (auto-cadastro)
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cpf_cnpj VARCHAR(20) UNIQUE,
    endereco TEXT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_nascimento DATE
);

-- Tabela para Funcionários
CREATE TABLE IF NOT EXISTS funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cpf_cnpj VARCHAR(20) UNIQUE,
    endereco TEXT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_nascimento DATE,
    cargo VARCHAR(100) NOT NULL, -- Ex: 'Estagiário', 'Atendente', 'Gerente', 'CEO'
    tipo_contrato VARCHAR(50) NOT NULL -- Ex: 'CLT', 'PJ', 'Estágio'
);

-- Tabela para Produtos
-- Se você tiver uma tabela de categorias, adicione FOREIGN KEY
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL,
    categoria_id INT, -- Se tiver uma tabela de categorias, use o ID da categoria
    imagem VARCHAR(255), -- Para armazenar o nome do arquivo da imagem (ex: 'maca.jpg')
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Opcional: Tabela de Categorias (se você quiser gerenciar categorias de produtos)
-- Se você já tem uma tabela de categorias, pode remover este bloco.
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
);

-- Opcional: Adicionar a FOREIGN KEY para categoria_id na tabela produtos
-- Execute este ALTER TABLE APENAS se a tabela 'categorias' existir.
-- ALTER TABLE produtos
-- ADD CONSTRAINT fk_produto_categoria
-- FOREIGN KEY (categoria_id) REFERENCES categorias(id)
-- ON DELETE SET NULL; -- Ou ON DELETE CASCADE, dependendo do comportamento desejado