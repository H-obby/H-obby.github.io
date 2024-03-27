<?php

//require_once("controllers/Database.php");
require_once("controllers/MainManager.php");
require_once("controllers/Render.php");
class MainController extends Render{
    public $mainManager;

    public function __construct(){
        $this->mainManager = new MainManager();
    }

    public function index(){
        $data_index = [
            "page_description" => "Page d'accueil",
            "page_title" => "Page d'accueil",
            "page_css" => ["index.css"],
            "view" => "views/notLogged/landing.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_index);
    }

    public function login(){
        $data_login = [
            "page_description" => "Connection",
            "page_title" => "Connection",
            "page_css" => ["login-page.css"],
            "view" => "views/notLogged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_login);
    }

    public function loggedLanding(){
        $datas = $_SESSION["permissionLevel"] == 3 ? $this->mainManager->getAdminName() : $this->mainManager->getUserName();
        $data_index = [
            "page_description" => "Espace Utilisateur",
            "page_title" => "Espace Utilisateur",
            "page_css" => ["logged-in-landing.css"],
            "datas" => $datas,
            "view" => "views/logged/landing.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_index);
    }
    
    public function search(){
		$filter_options = [];
		if(isset($_POST["date"]) && $_POST["date"] != "null"){
			$date = $_POST["date"];
			$filter_options["date"] = $date;
		}
		if(isset($_POST["duree"]) && $_POST["duree"] != "null"){
			$duree = $_POST["duree"];
			$filter_options["duree"] = $duree;
		}
		if(isset($_POST["niv"]) && $_POST["niv"] != "null"){
			$niv = $_POST["niv"];
			$filter_options["niv"] = $niv;
		} 
		if(isset($_POST["sec"]) && $_POST["sec"] != "null"){
			$sec = $_POST["sec"];
			$filter_options["sec"] = $sec;
		} 

        switch($_POST["searchType"]){
            case "stage":
                $datas["stages"] = $this->mainManager->looseGetRechercheStage(
                    $_POST["searchValue"],
                    $filter_options
                );
                break;
            default:
                $datas = [];
                break;
        }

        $datas["searchType"] = $_POST["searchType"];
        $datas["searchValue"] = $_POST["searchValue"];

        $data_search = [
            "page_description" => "Recherche de ".$_POST["searchType"],
            "page_title" => "Recherche ".$_POST["searchType"],
            "page_css" => ["page-recherche.css"],
            "componentCSS" => ["offre-stage.css", "search-bar.css", "logged-in-header.css"],
            "datas" => $datas,
            "view" => "views/logged/page-recherche.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_search);
    }

    public function affiche(){
        $datas = [];
        $data_search = [
            "page_description" => "Affichage",
            "page_title" => "Affichage",
            "page_css" => ["visu-offre-stage.css"],
            "componentCSS" => ["search-bar.css", "logged-in-header.css"],
            "datas" => $datas,
            "view" => "views/logged/visustage.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_search);
    }

    public function mentions(){
        $data_mentions = [
            "page_description" => "Mentions legales",
            "page_title" => "Mentions-legales",
            "page_css" => ["mentions-lgales.css"],
            "view" => "views/notLogged/mentions.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_mentions);
    }

    public function ModifEtudiant(){
        $data_ModifEtudiant = [
            "page_description" => "Modifier Etudiant",
            "page_title" => "ModifEtudiant",
            "page_css" => ["modif-etudiant.css"],
            "view" => "views/Logged/modifetu.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_ModifEtudiant);
    }

    public function Modifoffre(){
        $data_Modifoffre = [
            "page_description" => "Modifier offre entreprise",
            "page_title" => "Modifoffre",
            "page_css" => ["modif-offre-entre.css"],
            "view" => "views/Logged/modifoffre.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_Modifoffre);
    }

    public function Modifstage(){
        $data_Modifstage = [
            "page_description" => "Modifier offre stage",
            "page_title" => "Modifoffrestage",
            "page_css" => ["modif-offre-entre.css"],
            "view" => "views/Logged/modifstage.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_Modifstage);
    }

    public function Modiftuteur(){
        $data_Modiftuteur = [
            "page_description" => "Modifier Tuteur",
            "page_title" => "Modiftuteur",
            "page_css" => ["modif-tuteur.css"],
            "view" => "views/Logged/modiftuteur.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_Modiftuteur);
    }

    public function recherchetuteur(){
        $data_recherchetuteur = [
            "page_description" => "Page Recherche Tuteur",
            "page_title" => "page recherche tuteur",
            "page_css" => ["Page-Recherche-Tuteur.css"],
            "view" => "views/Logged/recherchetuteur.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_recherchetuteur);
    }

    public function rechercheutilisateur(){
        $data_rechercheutilisateur = [
            "page_description" => "Page Recherche utilisateur",
            "page_title" => "Page Recherche Utilisateur",
            "page_css" => ["page-recherche-utilisateur.css"],
            "view" => "views/Logged/rechercheutilisateur.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_rechercheutilisateur);
    }

    public function visuentre(){
        $data_visuentre = [
            "page_description" => "Visualisation entreprise",
            "page_title" => "visu entrpris",
            "page_css" => ["visu-entrpris.css"],
            "view" => "views/Logged/visuentre.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visuentre);
    }

    public function visututeur(){
        $data_visututeur = [
            "page_description" => "Visualisation tuteur",
            "page_title" => "visu tuteur",
            "page_css" => ["visu-tuteur.css"],
            "view" => "views/Logged/visututeur.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visututeur);
    }

    public function visuetu(){
        $data_visuetu = [
            "page_description" => "Visualisation etudiant",
            "page_title" => "visu etudiant",
            "page_css" => ["visu-etudiant.css"],
            "view" => "views/Logged/visuetudiant.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visuetu);
    }

    public function visuoffre(){
        $data_visuoffre = [
            "page_description" => "Visualisation offre de stage",
            "page_title" => "visu offre stage",
            "page_css" => ["visu-offre-stage.css"],
            "view" => "views/Logged/visustage.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visuoffre);
    }

    public function wishlist(){
        $data_wishlist = [
            "page_description" => "Wishlist offre stage",
            "page_title" => "Wishlist",
            "page_css" => ["wishlist.css"],
            "view" => "views/logged/wishlist.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_wishlist);
    }
}
