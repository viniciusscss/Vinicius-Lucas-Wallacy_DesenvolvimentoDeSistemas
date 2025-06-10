-- database/seeds.sql

-- Inserção de Categorias (se a tabela de categorias existir)
INSERT INTO categorias (nome) VALUES
('Frutas'),
('Legumes'),
('Verduras');

-- Inserção de Produtos (9 exemplos)
INSERT INTO produtos (nome, preco, estoque, categoria_id, imagem) VALUES
('Maçã Fuji', 8.50, 150, (SELECT id FROM categorias WHERE nome = 'Frutas'), 'maca.jpg'),
('Tomate Caqui', 5.99, 200, (SELECT id FROM categorias WHERE nome = 'Legumes'), 'tomate.jpg'),
('Alface Crespa', 3.20, 80, (SELECT id FROM categorias WHERE nome = 'Verduras'), 'alface.jpg'),
('Banana Prata', 6.00, 120, (SELECT id FROM categorias WHERE nome = 'Frutas'), 'banana.jpg'),
('Cenoura', 4.50, 180, (SELECT id FROM categorias WHERE nome = 'Legumes'), 'cenoura.jpg'),
('Laranja Pera', 4.90, 250, (SELECT id FROM categorias WHERE nome = 'Frutas'), 'laranja.jpg'),
('Batata Doce', 7.20, 100, (SELECT id FROM categorias WHERE nome = 'Legumes'), 'batata_doce.jpg'),
('Espinafre', 4.00, 60, (SELECT id FROM categorias WHERE nome = 'Verduras'), 'espinafre.jpg'),
('Pimentão Verde', 9.50, 90, (SELECT id FROM categorias WHERE nome = 'Legumes'), 'pimentao_verde.jpg');

-- Inserção de um Funcionário de Cargo de Ponta (para testes de login)
-- A senha 'senha123' será hashada no banco de dados.
-- Use um gerador de hash (ex: password_hash('senha123', PASSWORD_DEFAULT))
-- ou insira manualmente no phpMyAdmin para gerar o hash.
-- Exemplo de hash para 'senha123': $2y$10$seu_hash_de_senha_aqui (este é um PLACEHOLDER)
-- Você precisará gerar um hash real para 'senha123' e colocá-lo aqui.
-- O hash para 'senha123' é gerado por `password_hash('senha123', PASSWORD_DEFAULT);`
INSERT INTO funcionarios (nome, email, senha, telefone, cpf_cnpj, endereco, data_nascimento, cargo, tipo_contrato) VALUES
('Chefe Horti', 'chefe@hortifruti.com', '$2y$10$q2R8wS7.Q7W9N3K1Y2X40O0.z2N5c2V5n4p1T3z2q6c7d8e9f0a1', '41988887777', '99988877766', 'Rua Principal, 100 - Centro', '1980-05-15', 'CEO', 'CLT');

-- Inserção de um Cliente de Exemplo (para testes)
-- A senha 'clientesenha' será hashada no banco de dados.
INSERT INTO clientes (nome, email, senha, telefone, cpf_cnpj, endereco, data_nascimento) VALUES
('Cliente Exemplo', 'cliente@example.com', '$2y$10$a1B2c3D4e5F6g7H8i9J0k1L2m3N4o5P6q7R8s9T0u1V2w3X4y5Z6', '41999998888', '11122233344', 'Rua Cliente, 45 - Bairro', '1995-11-20');