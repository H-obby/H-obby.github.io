<!-- Connexion à la base de données-->
<?php
/* Configuration des variables d'environnement */
define('DB_HOST', 'localhost');
define('DB_NAME', 'WS6');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

function getConnexion()
{
    /* Utilisation de PDO dans un try and catch afin de se connecter à la base de données */
    // PHP se connecte au SQL s'il y arrive sinon on renvoie une erreur
    try {
        return new PDO('mysql:host='.DB_HOST.';port=3307;dbname='.DB_NAME, DB_USER, DB_PASSWORD, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // On veut un tableau associatif en résultat par défaut
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]);
    } catch (Exception $exception) {
        echo '<h1>'.$exception->getMessage().'</h1>';
        echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
        die; // On arrête le code PHP
    }
}