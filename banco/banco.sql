CREATE DATABASE IF NOT EXISTS petshop;

USE petshop;

CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS especie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS pet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nascimento DATE NOT NULL,
    genero CHAR(1) NOT NULL,
    prontuario TEXT,
    especie_id INT NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,

    FOREIGN KEY (especie_id)
        REFERENCES especie(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

INSERT INTO usuario (nome, email, senha)
VALUES ('Administrador', 'admin@petshop.com', '123456');

INSERT INTO especie (nome) VALUES
('Cachorro'),
('Gato'),
('Ave'),
('Coelho');