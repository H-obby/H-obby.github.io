<?php
require_once("controllers/Database.php");

class MainManager {

    private $dbConnect;
    
    public function __construct() {
        $this->dbConnect = getConnexion();
    }

    public function getUserName(){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT prenom
                FROM utilisateur
                WHERE login = :login
                limit 1"
            );
            $query->bindvalue(":login", $_SESSION["loggedAs"]);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
        $data = [
            "username" => $query->fetchAll()[0]["prenom"],
        ];
        return $data;
    }

    public function getAdminName(){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT prenom
                FROM administrateur
                WHERE login = :login
                limit 1"
            );
            $query->bindvalue(":login", $_SESSION["loggedAs"]);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
        $data = [
            "username" => $query->fetchAll()[0]["prenom"],
        ];
        return $data;
    }

    function getMDP($login){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT mot_de_passe
                FROM utilisateur
                WHERE login = :login
                limit 1"
            );
            $query->bindvalue(":login", $login);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    function getMDPAdmin($login){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT mot_de_passe
                FROM administrateur
                WHERE login = :login
                limit 1"
            );
            $query->bindvalue(":login", $login);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    function getPermissionLevel($type){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT type
                FROM utilisateur
                WHERE type = :type
                limit 1"
            );
            $query->bindvalue(":type", $type);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    public function looseGetRechercheStage($searchValue):array{
        try {
            $query = $this->dbConnect->prepare(
                "SELECT id_stage 
                FROM stage 
                WHERE 
                (titre              LIKE :search 
                OR competences         LIKE :search 
                OR adresse             LIKE :search 
                OR promo_concernees    LIKE :search 
                OR duree               LIKE :search 
                OR remuneration        LIKE :search 
                OR description         LIKE :search 
                OR date_offre          LIKE :search)"
            );
            $query->bindValue(":search", '%'.$searchValue.'%');
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    public function getStageFromID(int $id){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT titre, competences, adresse, promo_concernees,
                remuneration, date_offre, places_disponibles, description, duree
                FROM stage 
                WHERE :id = id_stage"
            );
            $query->bindValue(":id", $id);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }
}
