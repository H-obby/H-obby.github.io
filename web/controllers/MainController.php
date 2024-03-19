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

    
}