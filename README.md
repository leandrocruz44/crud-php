#Database e tabela

CREATE DATABASE IF NOT EXISTS projeto_crud;

USE projeto_crud;

CREATE TABLE IF NOT EXISTS avaliacao_de_filmes (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_filme VARCHAR(100) NOT NULL,
    nota ENUM('1','2','3','4','5') NOT NULL,
    resenha TEXT,
    favorito INT
);