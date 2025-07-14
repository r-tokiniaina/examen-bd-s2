CREATE DATABASE marche;
USE marche;

CREATE TABLE marche_membre(
    id_membre INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    date_de_naissance DATE,
    genre CHAR(1),
    email VARCHAR(50),
    ville VARCHAR(50),
    mdp VARCHAR(10),
    image_profil VARCHAR(100)
);

CREATE TABLE marche_categorie_objet(
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(20)
);

CREATE TABLE marche_objet(
    id_objet INT PRIMARY KEY AUTO_INCREMENT,
    nom_objet VARCHAR(50),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES marche_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES marche_membre(id_membre)
);

CREATE TABLE marche_images_objet(
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT,
    nom_image VARCHAR(20),
    FOREIGN KEY (id_objet) REFERENCES marche_objet(id_objet)
);

CREATE TABLE marche_emprunt(
    id_emprunt INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT,
    id_membre INT, 
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES marche_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES marche_membre(id_membre)
);

INSERT INTO marche_membre (nom, date_de_naissance, genre, email, ville, mdp, image_profil) VALUES
    ('Alice', '2000-05-10', 'F', 'alice@example.com', 'Tana', 'alice123', 'membre-1.png'),
    ('Bob', '1998-11-23', 'M', 'bob@example.com', 'Majunga', 'bob123', 'membre-2.png'),
    ('Charlie', '1995-03-14', 'M', 'charlie@example.com', 'Fianarantsoa', 'charlie123', 'membre-3.png'),
    ('Dina', '2002-07-01', 'F', 'dina@example.com', 'Toamasina', 'dina123', 'membre-4.png');

INSERT INTO marche_categorie_objet(nom_categorie) VALUES
    ("esthetique"), ("bricolage"), ("mecanique"), ("cuisine");

INSERT INTO marche_objet (nom_objet, id_categorie, id_membre) VALUES
('Crème visage', 1, 1),
('Tournevis', 2, 1),
('Mixer', 4, 1),
('Sèche-cheveux', 1, 1),
('Perceuse', 2, 1),
('Four', 4, 1),
('Pinceau maquillage', 1, 1),
('Scie', 2, 1),
('Casserole', 4, 1),
('Tondeuse', 1, 1),

('Marteau', 2, 2),
('Poêle', 4, 2),
('Roulette de vélo', 3, 2),
('Friteuse', 4, 2),
('Ponceuse', 2, 2),
('Batterie', 3, 2),
('Fourchette électrique', 4, 2),
('Tournevis plat', 2, 2),
('Crème solaire', 1, 2),
('Plaque cuisson', 4, 2),

('Ampli voiture', 3, 3),
('Fer à lisser', 1, 3),
('Scie sauteuse', 2, 3),
('Grille-pain', 4, 3),
('Tournevis étoile', 2, 3),
('Casque audio', 3, 3),
('Spatule', 4, 3),
('Cire capillaire', 1, 3),
('Tournevis cruciforme', 2, 3),
('Moteur de trottinette', 3, 3),

('Crayon sourcil', 1, 4),
('Scie circulaire', 2, 4),
('Clé à molette', 2, 4),
('Moule gâteau', 4, 4),
('Parfum', 1, 4),
('Lisseur vapeur', 1, 4),
('Poignée porte', 2, 4),
('Mixeur plongeant', 4, 4),
('Bougie parfumée', 1, 4),
('Boîte outils', 2, 4);

INSERT INTO marche_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-05'),
(5, 3, '2025-07-02', '2025-07-06'),
(12, 1, '2025-07-03', '2025-07-07'),
(15, 4, '2025-07-04', '2025-07-08'),
(20, 1, '2025-07-01', '2025-07-10'),
(22, 2, '2025-07-02', '2025-07-12'),
(27, 3, '2025-07-05', '2025-07-15'),
(31, 1, '2025-07-06', '2025-07-13'),
(35, 2, '2025-07-07', '2025-07-11'),
(38, 3, '2025-07-08', '2025-07-14');
