<?php

require_once("controllers/MainManager.php");
require_once("controllers/Render.php");
require_once("controllers/Toolbox.php");
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
        if($_SESSION["permissionLevel"] > 0){
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
        } else {
            $this->login();
        }
    }
    
    public function search(){
        if($_SESSION["permissionLevel"] > 0){
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

            if(isset($_POST["creation"])){
                header("Location: modification");
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
        } else {
            $this->login();
        }
    }

    public function affiche(){
        if($_SESSION["permissionLevel"] > 0){
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
        } else {
            $this->login();
        }
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

    public function modification(){
        $data_mod = [
            "page_description" => "Modification d'offre de stage",
            "page_title" => "Modification de stages",
            "page_css" => ["modif-offre-stage.css"],
            "view" => "views/Logged/modifstage.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_mod);
    }

    public function visuoffre(){
        if($_SESSION["permissionLevel"] > 0){
            $data_visuoffre = [
                "page_description" => "Visualisation offre de stage",
                "page_title" => "visu offre stage",
                "page_css" => ["visu-offre-stage.css"],
                "view" => "views/Logged/visustage.php",
                "template" => "layouts/base.php",
            ];
            $this->render($data_visuoffre);
        } else {
            $this->login();
        }
    }

    public function wishlist(){
        if($_SESSION["permissionLevel"] > 0){
            $data_wishlist = [
                "page_description" => "Wishlist offre stage",
                "page_title" => "Wishlist",
                "page_css" => ["wishlist.css"],
                "view" => "views/logged/wishlist.php",
                "template" => "layouts/base.php",
            ];
            $this->render($data_wishlist);
        } else {
            $this->login();
        }
    }

    public function assistance()
    {
        $data_assistance = [
            "page_description" => "Page d'assistance",
            "page_title" => "Assistance offre stage",
            "page_css" => ["assistance.css"],
            "view" => "views/notLogged/assistance.php",
            "template" => "layouts/base.php",
        ];
        $this->render($data_assistance);
    }

    public function addWishlist($postData){
        $this->mainManager->setFavorite($postData["id"]);
    }

    public function getEntrepriseName($curSearch){
        $this->mainManager->getEntrepriseName($curSearch["search"]);
    }

    public function createEmptyEntreprise($name){
        $this->mainManager->createEmptyEntreprise($name["nom"]);
    }

    public function ajaxHandleAlert($postData){
        Toolbox::addAlert($postData["message"], $postData["type"]);
    }

    public function ajaxRemoveStage($postData){
        $this->mainManager->removeStage($postData["id"]);
    }
}
