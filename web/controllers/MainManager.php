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

    public function looseGetRechercheStage($searchValue, $filters):array{
        try {
            $requete = "SELECT id_stage, MATCH(
                            titre, competences, adresse,
                            domaine_activite, description) 
                        AGAINST (:relSearch IN BOOLEAN MODE) AS relevancy_score
                        FROM stage 
                        WHERE 
                        (
                        MATCH (titre, competences, adresse,
                               domaine_activite, description) 
                        AGAINST (:relSearch IN BOOLEAN MODE) > 0
                        OR promo_concernees    LIKE :search 
                        OR duree               LIKE :search 
                        OR remuneration        LIKE :search 
                        OR date_offre          LIKE :search)";
            
			if(isset($filters["duree"])) {
                switch($filters["duree"]){
                    case "2m":
                        $requete .= "AND (duree = '2 mois')";
                        break;
                    case "34m":
                        $requete .= "AND (duree = '3 mois' OR duree = '4 mois')";
                        break;
                    case "56m":
                        $requete .= "AND (duree = '5 mois' OR duree = '6 mois')";
                        break;
                    case "6+m":
                        $requete .= "AND (CAST(SUBSTRING(duree, 1, 1) AS INT) >= 6)";
                        break;
                    default:
                        break;
                }
                $requete .= " ";
            }
            if(isset($filters["date"])) {
                switch($filters["date"]){
                    case "24h":
                        $requete .= "AND (TIMESTAMPDIFF(HOUR, date_offre, NOW()) < 24)";
                        break;
                    case "3dj":
                        $requete .= "AND (TIMESTAMPDIFF(DAY, date_offre, NOW()) < 3)";
                        break;
                    case "7dj":
                        $requete .= "AND (TIMESTAMPDIFF(DAY, date_offre, NOW()) < 7)";
                        break;
                    case "14dj":
                        $requete .= "AND (TIMESTAMPDIFF(DAY, date_offre, NOW()) < 14)";
                        break;
                    default:
                        break;
                }
                $requete .= " ";
            }
            if(isset($filters["niv"])) {
                switch($filters["niv"]){
                    case "b+2":
                        $requete .= "AND (promo_concernees = 'bac+2')";
                        break;
                    case "b+3":
                        $requete .= "AND (promo_concernees = 'bac+3')";
                        break;
                    case "b+4":
                        $requete .= "AND (promo_concernees = 'bac+4')";
                        break;
                    case "b+5":
                        $requete .= "AND (promo_concernees = 'bac+5')";
                        break;
                    default:
                        break;
                }
                $requete .= " ";
            }
            if(isset($filters["sec"])) {
                switch($filters["sec"]){
                    case "info":
                        $requete .= "AND (domaine_activite = 'Informatique')";
                        break;
                    case "btp":
                        $requete .= "AND (domaine_activite = 'BTP')";
                        break;
                    default:
                        break;
                }
                $requete .= " ";
            }
            $requete .= "ORDER BY relevancy_score DESC, date_offre DESC";
            
            $query = $this->dbConnect->prepare($requete);
            if($searchValue != ""){
                $splitted = preg_split('/\s+/', $searchValue);
                foreach ($splitted as $key=>$value){
                    if(substr($value, 0, 1) != "+") {
                        $splitted[$key] = "*".$value."*";
                    }
                }
                $query->bindValue(":relSearch", implode(" ", $splitted));
            } else {
                $query->bindValue(":relSearch",$searchValue);
            }
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
                "SELECT stage.titre, stage.competences, stage.adresse, stage.promo_concernees,
                stage.remuneration, stage.date_offre, stage.places_disponibles, stage.description, stage.duree,
                stage.domaine_activite as domaine, entreprise.nom as nom_entreprise
                FROM stage JOIN entreprise ON stage.id_entreprise = entreprise.id_entreprise
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

    public function setFavorite($id_stage){
        try { // On vérifie si la relation existe déjà
            $query = $this->dbConnect->prepare(
                "SELECT * FROM relation
                WHERE (id_stage = :id_stage 
                AND id_utilisateur = (SELECT id_utilisateur
                FROM utilisateur
                WHERE login = :login))"
            );
            $query->bindValue(":id_stage", $id_stage);
            $query->bindValue(":login", $_SESSION["loggedAs"]);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
        
        if ($query->rowCount() == 0){ // Si la relation n'existe pas, on la crée
            try {
                $query = $this->dbConnect->prepare(
                    "INSERT INTO relation (id_stage, id_utilisateur)
                    VALUES (:id_stage, (SELECT id_utilisateur
                    FROM utilisateur
                    WHERE login = :login))"
                );
                $query->bindValue(":id_stage", $id_stage);
                $query->bindValue(":login", $_SESSION["loggedAs"]);
                $query->execute();
            } catch (Exception $exception) {
                echo '<h1>'.$exception->getMessage().'</h1>';
                echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
                die; // On arrête le code PHP
            }
        }

        try { 
            try {
                $query = $this->dbConnect->prepare( // On vérifie si la relation est déjà wish-listed
                    "SELECT wish_listed FROM relation
                    WHERE (id_stage = :id_stage 
                    AND id_utilisateur = (SELECT id_utilisateur
                    FROM utilisateur
                    WHERE login = :login))"
                );
                $query->bindValue(":id_stage", $id_stage);
                $query->bindValue(":login", $_SESSION["loggedAs"]);
                $query->execute();
            } catch (Exception $exception) {
                echo '<h1>'.$exception->getMessage().'</h1>';
                echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
                die; // On arrête le code PHP
            }

            if($query->fetchAll()[0]["wish_listed"]) { // Si elle l'est, on la retire de la wish-list
                $query = $this->dbConnect->prepare(
                    "UPDATE `relation` 
                    SET wish_listed = 0
                    WHERE (id_stage = :id_stage 
                    AND id_utilisateur = (SELECT id_utilisateur
                    FROM utilisateur
                    WHERE login = :login))"
                );
            } else { // Sinon, on l'ajoute
                $query = $this->dbConnect->prepare(
                    "UPDATE `relation` 
                    SET wish_listed = 1
                    WHERE (id_stage = :id_stage 
                    AND id_utilisateur = (SELECT id_utilisateur
                    FROM utilisateur
                    WHERE login = :login))"
                );
            }
            $query->bindValue(":id_stage", $id_stage);
            $query->bindValue(":login", $_SESSION["loggedAs"]);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }
}
