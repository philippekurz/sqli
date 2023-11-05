DROP DATABASE IF EXISTS `test_csrf`;

CREATE DATABASE `test_csrf` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_csrf`;

CREATE TABLE utilisateurs (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(70) NOT NULL,
    prenom VARCHAR(70) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    admin tinyint(1) NOT NULL DEFAULT '0'
);

CREATE TABLE articles (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    categorie_id int(11) NOT NULL,
    nom VARCHAR(70) NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL
);

CREATE table categories (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(70) NOT NULL
);

-- Mot de passe : test
INSERT INTO utilisateurs
    (nom, prenom, email, password, telephone, admin)
VALUES
    -- ('Dupont', 'Pierre', 'pierre.dupont@gmail.com', '$2y$10$s/gEZWw2k9l25QBgAodK3.qlnWKdN7ylIUCRJteY7itUy3xJlAcTq', 1),
    -- ('Durand', 'Marc', 'marc.durand@gmail.com', '$2y$10$s/gEZWw2k9l25QBgAodK3.qlnWKdN7ylIUCRJteY7itUy3xJlAcTq', 0),
    -- ('Robert', 'Julien', 'julien.robert@gmail.com', '$2y$10$s/gEZWw2k9l25QBgAodK3.qlnWKdN7ylIUCRJteY7itUy3xJlAcTq', 0);
    ('Dupont', 'Pierre', 'pierre.dupont@gmail.com', 'test', '01 23 45 67 89', 1),
    ('Durand', 'Marc', 'marc.durand@gmail.com', 'test', '01 23 45 67 89', 0),
    ('Robert', 'Julien', 'julien.robert@gmail.com', 'test', '01 23 45 67 89', 0);

SELECT * FROM utilisateurs;

INSERT INTO categories
    (nom)   
VALUES
    ('Haut'),
    ('Pantalon'),
    ('Chaussures'),
    ('Accessoires');

INSERT INTO articles
    (nom, description, prix, image, categorie_id)
VALUES
    ('T-shirt', 'T-shirt en coton', 15.99, 'tshirt.jpg',1),
    ('Pantalon', 'Pantalon en coton', 29.99, 'pantalon.jpg',2),
    ('Chaussures', 'Chaussures en cuir', 49.99, 'chaussures.jpg',3),
    ('Casquette', 'Casquette en coton', 9.99, 'casquette.jpg',4),
    ('Pull', 'Pull en laine', 39.99, 'pull.jpg',1),
    ('Veste', 'Veste en cuir', 59.99, 'veste.jpg',1),
    ('Short', 'Short en coton', 19.99, 'short.jpg',2),
    ('Chaussettes', 'Chaussettes en coton', 4.99, 'chaussettes.jpg',3),
    ('Echarpe', 'Echarpe en laine', 9.99, 'echarpe.jpg',4),
    ('Bonnet', 'Bonnet en laine', 9.99, 'bonnet.jpg',4),
    ('Gants', 'Gants en laine', 9.99, 'gants.jpg',4),
    ('Ceinture', 'Ceinture en cuir', 9.99, 'ceinture.jpg',4);


SELECT * FROM articles;