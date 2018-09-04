CREATE DATABASE jogo;
USE jogo;

CREATE TABLE sjf(
id INTEGER AUTO_INCREMENT PRIMARY KEY,
nomeProcesso VARCHAR(20),
tamanho INTEGER,
status INTEGER);
# 1 , 2 , 3  =  Novo , Fila , Processado

SELECT * FROM sjf;

#DROP DATABASE jogo;