<?php
require_once("controllers/MainController.controller.php");
$controller = new MainController();

if(empty($_GET['page'])){
    $page = 'index';
} else {
    $url = explode("/", filter_var($_GET["page"], FILTER_SANITIZE_URL));
    $page = $url[0];
}

try{
    switch ($page){
        case "index":
            $controller->index();
            break;

        case "login":
            $controller->login();
            break;

        default:
            throw new Exception("La page n'existe pas - ". $page);
    }
} catch(Exception $e){
    $page_description = "Page 404";
    $page_title = "Erreur";
    $page_content = $e->getMessage();
}
require_once("layouts/base.php");