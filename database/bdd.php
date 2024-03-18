<?php
$host = 'localhost';
$dbname = 'pro';
$user = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création des tables
$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Promotion (
        id_promo INT,
        promo VARCHAR(50) NOT NULL,
        PRIMARY KEY(id_promo)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Entreprise (
        id_entreprise INT,
        nom VARCHAR(50) NOT NULL,
        secteur_d_activite INT,
        mail VARCHAR(50),
        PRIMARY KEY(id_entreprise)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Adresse (
        id_addresse INT,
        addresse VARCHAR(100) NOT NULL,
        PRIMARY KEY(id_addresse)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Stage (
        id_stage VARCHAR(50),
        competences VARCHAR(50),
        adresse VARCHAR(50),
        promo_concernees VARCHAR(50),
        duree VARCHAR(50),
        remuneration DECIMAL(15,2),
        date_offre DATE,
        places_disponibles INT,
        id_entreprise INT NOT NULL,
        PRIMARY KEY(id_stage),
        FOREIGN KEY(id_entreprise) REFERENCES Entreprise(id_entreprise)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Administrateur (
        id_admin INT,
        login VARCHAR(50) NOT NULL,
        mot_de_passe VARCHAR(50) NOT NULL,
        nom VARCHAR(50),
        prenom VARCHAR(50),
        PRIMARY KEY(id_admin)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Utilisateur (
        id_utilisateur INT,
        nom VARCHAR(50) NOT NULL,
        prenom VARCHAR(50) NOT NULL,
        mail VARCHAR(50) NOT NULL UNIQUE,
        mot_de_passe VARCHAR(50) NOT NULL,
        PRIMARY KEY(id_utilisateur)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Appartenir (
        id_utilisateur INT,
        id_promo INT,
        PRIMARY KEY(id_utilisateur, id_promo),
        FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
        FOREIGN KEY(id_promo) REFERENCES Promotion(id_promo)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Evaluation (
        id_utilisateur INT,
        note INT,
        id_entreprise INT NOT NULL,
        PRIMARY KEY(id_utilisateur),
        FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
        FOREIGN KEY(id_entreprise) REFERENCES Entreprise(id_entreprise)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Se_situer (
        id_entreprise INT,
        id_addresse INT,
        PRIMARY KEY(id_entreprise, id_addresse),
        FOREIGN KEY(id_entreprise) REFERENCES Entreprise(id_entreprise),
        FOREIGN KEY(id_addresse) REFERENCES Adresse(id_addresse)
    )
");
$stmt->execute();

$stmt = $conn->prepare("
    CREATE TABLE IF NOT EXISTS Relation (
        id_utilisateur INT,
        id_stage VARCHAR(50),
        wish_listed BOOLEAN,
        status_offre INT,
        PRIMARY KEY(id_utilisateur, id_stage),
        FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
        FOREIGN KEY(id_stage) REFERENCES Stage(id_stage)
    )
");
$stmt->execute();

echo "Base de données et tables créées avec succès.";
?>