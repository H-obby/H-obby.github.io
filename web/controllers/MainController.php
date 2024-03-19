<?php

//require_once("controllers/Database.php");
require_once("controllers/MainManager.php");
require_once("controllers/Render.php");
class MainController extends Render{
    private $mainManager;

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
        $datas = $this->mainManager->getSampleUser();
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
        $data_search = [
            "type_recherche" => $_POST["search-type"], 
            "page_description" => "Recherche de ".$_POST["search-type"],
            "page_title" => "Recherche",
            "page_css" => ["page-recherche.css"],
            "view" => "views/logged/page-recherche.php",
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
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_ModifEtudiant);
    }

    public function Modifoffre(){
        $data_Modifoffre = [
            "page_description" => "Modifier offre entreprise",
            "page_title" => "Modifoffre",
            "page_css" => ["modif-offre-entre.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_Modifoffre);
    }

    public function Modifstage(){
        $data_Modifstage = [
            "page_description" => "Modifier offre stage",
            "page_title" => "Modifoffrestage",
            "page_css" => ["modif-offre-entre.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_Modifstage);
    }

    public function Modiftuteur(){
        $data_Modiftuteur = [
            "page_description" => "Modifier Tuteur",
            "page_title" => "Modiftuteur",
            "page_css" => ["modif-tuteur.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_Modiftuteur);
    }

    public function recherchetuteur(){
        $data_recherchetuteur = [
            "page_description" => "Page Recherche Tuteur",
            "page_title" => "page recherche tuteur",
            "page_css" => ["Page-Recherche-Tuteur.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_recherchetuteur);
    }

    public function rechercheutilisateur(){
        $data_rechercheutilisateur = [
            "page_description" => "Page Recherche utilisateur",
            "page_title" => "Page Recherche Utilisateur",
            "page_css" => ["page-recherche-utilisateur.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_rechercheutilisateur);
    }

    public function visuentre(){
        $data_visuentre = [
            "page_description" => "Visualisation entreprise",
            "page_title" => "visu entrpris",
            "page_css" => ["visu-entrpris.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visuentre);
    }

    public function visututeur(){
        $data_visututeur = [
            "page_description" => "Visualisation tuteur",
            "page_title" => "visu tuteur",
            "page_css" => ["visu-tuteur.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visututeur);
    }

    public function visuetu(){
        $data_visuetu = [
            "page_description" => "Visualisation etudiant",
            "page_title" => "visu etudiant",
            "page_css" => ["visu-etudiant.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visuetu);
    }

    public function visuoffre(){
        $data_visuoffre = [
            "page_description" => "Visualisation offre de stage",
            "page_title" => "visu offre stage",
            "page_css" => ["visu-offre-stage.css"],
            "view" => "views/Logged/login.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_visuoffre);
    }

}
