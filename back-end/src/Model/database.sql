
CREATE USER 'loja'@'localhost' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON * . * TO 'loja'@'localhost';
FLUSH PRIVILEGES;

CREATE DATABASE senha_eletronica;
use senha_eletronica;

CREATE TABLE `senha_eletronica`.`senhas` (
  `id`      INT NOT NULL AUTO_INCREMENT,
  `senha`   VARCHAR(255) NULL,
  `guiche`  VARCHAR(255) NULL,
  `status`  VARCHAR(255) NULL,
  `data`    VARCHAR(255) NULL,
PRIMARY KEY (`id`));


