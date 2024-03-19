<?php
require_once("controllers/Database.php");

class MainManager {

    private $dbConnect;
    
    public function __construct() {
        $this->dbConnect = getConnexion();
    }

    public function getSampleUser(){
        $data = [
            "username" => "Théo",
        ];
        return $data;
    }

    public function looseGetRechercheStage($searchValue){
        $query = $this->dbConnect->prepare(
            "SELECT id_stage 
            FROM stage 
            WHERE :search LIKE titre OR :search LIKE competences OR 
            :search LIKE adresse OR :search LIKE promo_concernees OR 
            :search LIKE duree OR :search LIKE remuneration OR 
            :search LIKE description OR :search LIKE date_offre"
        );
        $query->bindValue(":search", '%'.$searchValue.'%');
        $query->execute();
        return $query->fetchAll();
    }

    public function getStageFromID(int $id){
        $query = $this->dbConnect->prepare(
            "SELECT titre, competences, adresse, promo_concernees,
            remuneration, date_offre, places_disponibles, description 
            FROM stage 
            WHERE :id = id_stage"
        );
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetchAll();
    }
}

