<?php
class MainController{
    public function index(){
        $page_description = "Page d'accueil";
        $page_title = "Page d'accueil";
        ob_start();
        require_once("../views/notLogged/landing.php");
        $page_content = ob_get_clean();
        require_once("../layouts/base.php");
    }

    public function login(){
        $page_description = "Connection";
        $page_title = "Connection";
        ob_start();
        require_once("../views/notLogged/login.php");
        $page_content = ob_get_clean();
        require_once("../layouts/base.php");
    }

    public function loggedLanding(){
        $page_description = "Espace Utilisateur";
        $page_title = "Espace Utilisateur";
        ob_start();
        require_once("../views/logged/landing.php");
        $page_content = ob_get_clean();
        require_once("../layouts/base.php");
    }
}