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

    function getPermissionLevel($login){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT type
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
                        $requete .= "AND (CAST(LEFT(duree, charindex(' ', duree) - 1)  AS INT) >= 6)";
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

    public function looseGetRechercheEntreprise($searchValue):array{
        try {
            $requete = "SELECT id_entreprise, MATCH(nom, description) 
                        AGAINST (:relSearch IN BOOLEAN MODE) AS relevancy_score
                        FROM entreprise 
                        WHERE (
                        MATCH (nom, description) 
                        AGAINST (:relSearch IN BOOLEAN MODE) > 0
                        OR addresse_siege    LIKE :search)";

            $requete .= "ORDER BY relevancy_score DESC";
            
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

    public function getEntrepriseFromID(int $id){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT nom, secteur_d_activite, mail, addresse_siege, description, logo
                FROM entreprise
                WHERE :id = id_entreprise"
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

        try { // On vérifie si la relation est wish-listed
            if(MainManager::getFavorite($id_stage)) { // Si elle l'est, on la retire de la wish-list
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

    public function getFavorite($id_stage){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT wish_listed FROM relation
                WHERE (id_stage = :id_stage 
                AND id_utilisateur = (SELECT id_utilisateur
                FROM utilisateur
                WHERE login = :login))"
            );
            $query->bindValue(":id_stage", $id_stage);
            $query->bindValue(":login", $_SESSION["loggedAs"]);
            $query->execute();
            return $query->fetchAll()[0]["wish_listed"];
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }
    
    public function updateStage(int $id, $postData){
        try { 
            $duree = $postData["duree"];
            $promo_concernees = $postData["promo_concernees"];
            $competences = $postData["competences"];
            $remuneration = $postData["remuneration"];
            $adresse = $postData["adresse"];
            $places_disponibles = $postData["places_disponibles"];
            $titre = $postData["titre"];
            $desc = $postData["desc"];
            $now = date('Y-m-d H:i:s', time());
            $entreprise = $this->getEntrepriseIDFromName($postData["nom_entreprise"]);
            if(sizeof($entreprise) <= 0){
                return false;
            }

            $requete ="UPDATE `stage` SET 
                `titre`= :titre,
                `competences`= :competences,
                `adresse`= :adresse,
                `duree`= :duree,
                `remuneration`= :remuneration,
                `date_offre`= :now,
                `places_disponibles`= :places,
                `description`= :desc,
                `promo_concernees`= :promos,
                `id_entreprise`= :entreprise
                WHERE (id_stage = :id) LIMIT 1";

            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":id",             $id);
            $query->bindValue(":titre",          $titre);
            $query->bindValue(":competences",    $competences);
            $query->bindValue(":adresse",        $adresse);
            $query->bindValue(":duree",          $duree);
            $query->bindValue(":remuneration",   $remuneration);
            $query->bindValue(":now",            $now);
            $query->bindValue(":places",         $places_disponibles);
            $query->bindValue(":desc",           $desc);
            $query->bindValue(":promos",         $promo_concernees);
            $query->bindValue(":entreprise",     $entreprise[0]["id_entreprise"]);
            $query->execute();
            return true;
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    public function removeStage($id){
        try { 
            $requete ="DELETE FROM stage WHERE id_stage = :id LIMIT 1";
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":id", $id);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    public function createStage($postData):string{
        try { 
            $duree = $postData["duree"];
            $promo_concernees = $postData["promo_concernees"];
            $competences = $postData["competences"];
            $remuneration = $postData["remuneration"];
            $adresse = $postData["adresse"];
            $places_disponibles = $postData["places_disponibles"];
            $titre = $postData["titre"];
            $desc = $postData["desc"];
            $now = date('Y-m-d H:i:s', time());
            $entreprise = $this->getEntrepriseIDFromName($postData["nom_entreprise"]);
            if(sizeof($entreprise) <= 0){
                return "-1";
            }

            $requete ="INSERT INTO 
                `stage`(`titre`, `competences`,`adresse`,`duree`,`remuneration`,`date_offre`,
                `places_disponibles`,`description`,`promo_concernees`,`id_entreprise`)
                VALUES 
                (:titre,:competences,:adresse,:duree,:remuneration,:now,
                :places,:desc,:promos,:entreprise)";

            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":titre",          $titre);
            $query->bindValue(":competences",    $competences);
            $query->bindValue(":adresse",        $adresse);
            $query->bindValue(":duree",          $duree);
            $query->bindValue(":remuneration",   $remuneration);
            $query->bindValue(":now",            $now);
            $query->bindValue(":places",         $places_disponibles);
            $query->bindValue(":desc",           $desc);
            $query->bindValue(":promos",         $promo_concernees);
            $query->bindValue(":entreprise",     $entreprise[0]["id_entreprise"]);
            $query->execute();

            $justCreatedID = $this->dbConnect->lastInsertId("stage");
            return $justCreatedID;
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    public function getEntrepriseName($curSearch){
        try{
            $requete = "SELECT nom
            FROM entreprise 
            WHERE (MATCH (nom) AGAINST (:relSearch IN BOOLEAN MODE) > 0)
            ORDER BY MATCH (nom) AGAINST (:relSearch IN BOOLEAN MODE) DESC";
            
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":relSearch", '*'.$curSearch.'*');
            $query->execute();

            $data = array();
            $data = $query->fetchAll(PDO::FETCH_COLUMN);
            echo json_encode($data);
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    public function getEntrepriseIDFromName($name){
        try{
            $requete = "SELECT id_entreprise
            FROM entreprise 
            WHERE nom = :name
            LIMIT 1";

            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":name", $name);
            $query->execute();
            $id = $query->fetchAll();
            if(isset($id)){ //entreprise trouvée
                return $id;
            } else { //entreprise non-trouvée
                return false;
            }
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die;
        }
    }

    public function createEmptyEntreprise($name){
        try{
            $requete = "INSERT INTO `entreprise`(`nom`)
            VALUES (':nom')";
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":name",                 $name);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die;
        }
    }

    public function createEntreprise($data){
        try{
            $requete = "INSERT INTO `entreprise`(
                `nom`, `secteur_d_activite`, 
                `mail`, `addresse_siege`, `description`)
            VALUES (
                ':nom',':secteur_d_activite',
                ':mail',':addresse_siege',':description')
            ";
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":name",                 $data["name"]);
            $query->bindValue(":secteur_d_activite",   $data["secteur_d_activite"]);
            $query->bindValue(":mail",                 $data["mail"]);
            $query->bindValue(":addresse_siege",       $data["addresse_siege"]);
            $query->bindValue(":description",          $data["description"]);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die;
        }
    }

    public function looseGetUser($searchValue, $filters):array{
        try {
            $requete = "SELECT id_utilisateur ";
            if(isset($searchValue) && $searchValue != "") {
                $requete .= ", MATCH(
                    nom, prenom, centre) 
                AGAINST (:relSearch IN BOOLEAN MODE) AS relevancy_score ";
            }
            $requete .= "FROM utilisateur WHERE (type = 1) ";
            if(isset($searchValue) && $searchValue != "") {
                $requete .= "AND (
                MATCH (nom, prenom, centre) 
                AGAINST (:relSearch IN BOOLEAN MODE) > 0) ORDER BY relevancy_score DESC";
            }
            
            $query = $this->dbConnect->prepare($requete);
            if($searchValue != ""){
                $splitted = preg_split('/\s+/', $searchValue);
                foreach ($splitted as $key=>$value){
                    if(substr($value, 0, 1) != "+") {
                        $splitted[$key] = "*".$value."*";
                    }
                }
                $query->bindValue(":relSearch", implode(" ", $splitted));
            } 
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    public function getUserFromID(int $id){
        try {
            $query = $this->dbConnect->prepare(
                "SELECT utilisateur.nom as name, utilisateur.prenom as surname, promotion.centre as centre, 
                utilisateur.profilePic as pfp, promotion.promo as promo, promotion.displayName as promoName,
                utilisateur.login as login
                FROM utilisateur JOIN promotion ON promotion.id_promo = utilisateur.id_promo
                WHERE :id = id_utilisateur"
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

    public function removeUser($id){
        try { 
            $requete ="DELETE FROM appartenir WHERE id_utilisateur = :id";
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":id", $id);
            $query->execute();

            $requete ="DELETE FROM utilisateur WHERE id_utilisateur = :id LIMIT 1";
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":id", $id);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    
    public function updateUser(int $id, $postData){
        try { 
            if(isset($postData["login"])) $login = $postData["login"];
            if(isset($postData["pass"]) && $postData["pass"] != "") $password = hash("sha256", $postData["pass"]);
            if(isset($postData["name"])) $name = $postData["name"];
            if(isset($postData["surname"])) $surname = $postData["surname"];
            if(isset($postData["image"])) $image = $postData["image"];
            if(isset($postData["promoCode"])) {
                $promoCode = $postData["promoCode"];
                $promoID = $this->getPromoCodeFromName($promoCode);
                if(sizeof($promoID) <= 0){
                    return false;
                }
            }

            $requete ="UPDATE `utilisateur` SET  
                ".(isset($postData["login"]) ? "`login` = :login," : "")." 
                ".(isset($postData["pass"]) && $postData["pass"] != "" ? "`mot_de_passe`= :pass, " : "")." 
                ".(isset($postData["image"]) ? "`profilePic`= :pfp, " : "")." 
                ".(isset($postData["name"]) ? "`nom`= :nom, " : "")." 
                ".(isset($postData["surname"]) ? "`prenom`= :prenom, " : "")." 
                ".(isset($postData["promoCode"]) ? "`id_promo`= :idpromo, " : "")." 
                `type`= 1
                WHERE `id_utilisateur` = :id_user";

            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":id_user",             $id);
            if(isset($postData["login"]))                                   $query->bindValue(":login",          $login);
            if(isset($postData["pass"]) && $postData["pass"] != "")         $query->bindValue(":pass",           $password);
            if(isset($postData["image"]))                                   $query->bindValue(":pfp",            $image);
            if(isset($postData["name"]))                                    $query->bindValue(":nom",            $name);
            if(isset($postData["surname"]))                                 $query->bindValue(":prenom",         $surname);
            if(isset($postData["promoCode"]))                               $query->bindValue(":idpromo",        $promoID);
            $query->execute();
            return true;
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }
    public function createUser($postData):string{
        try { 
            $login = $postData["login"];
            $password = hash("sha256", $postData["pass"]);
            $name = $postData["name"];
            $surname = $postData["surname"];
            $image = isset($postData["image"]) ? $postData["image"] : "";
            $promoCode = $postData["promo"];
            $promoID = $this->getPromoCodeFromName($promoCode);
            if(sizeof($promoID) <= 0){
                return false;
            }

            $requete ="INSERT INTO 
                `utilisateur`(`login`, `mot_de_passe`, `profilePic`, `nom`, `prenom`, `id_promo`, `type`)
                VALUES 
                (:login,:pass,:pfp,:nom,:prenom,:idpromo,1)";

            
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":login",          $login);
            $query->bindValue(":pass",           $password);
            $query->bindValue(":pfp",            $image);
            $query->bindValue(":nom",            $name);
            $query->bindValue(":prenom",         $surname);
            $query->bindValue(":idpromo",        $promoID[0]["id_promo"]);
            $query->execute();

            $justCreatedID = $this->dbConnect->lastInsertId("utilisateur");
            return $justCreatedID;
        } catch (Exception $exception) {
            echo $requete;
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }


    public function getPromoCode($curSearch){
        try{
            $requete = "SELECT promo as label, promo as value, centre
            FROM promotion 
            WHERE (MATCH (promo) AGAINST (:relSearch IN BOOLEAN MODE) > 0) 
            OR (MATCH (displayName) AGAINST (:relSearch IN BOOLEAN MODE) > 0) 
            ORDER BY MATCH (promo) AGAINST (:relSearch IN BOOLEAN MODE) DESC, 
            MATCH (displayName) AGAINST (:relSearch IN BOOLEAN MODE) DESC";
            
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":relSearch", '*'.$curSearch.'*');
            $query->execute();

            $data = array();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die; // On arrête le code PHP
        }
    }

    
    public function getPromoCodeFromName($name){
        try{
            $requete = "SELECT id_promo
            FROM promotion 
            WHERE promo = :name
            LIMIT 1";

            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":name", $name);
            $query->execute();
            $id = $query->fetchAll();
            if(isset($id)){ //promo trouvée
                return $id;
            } else { //promo non-trouvée
                return false;
            }
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die;
        }
    }
    
    public function createPromo($postData){
        try{
            $requete = "INSERT INTO `promotion`(promo, displayName, centre)
            VALUES (:promo, :display, :centre)";
            $query = $this->dbConnect->prepare($requete);
            $query->bindValue(":promo",                 $postData["promo"]);
            $query->bindValue(":display",               $postData["display"]);
            $query->bindValue(":centre",                $postData["centre"]);
            $query->execute();
        } catch (Exception $exception) {
            echo '<h1>'.$exception->getMessage().'</h1>';
            echo '<a href="https://www.google.fr/search?q='.$exception->getMessage().'" target="_blank">Recherche Google</a>';
            die;
        }
    }
}
