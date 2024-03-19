<?php
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http").
    "://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]));

require_once("controllers/MainController.php");
$controller = new MainController();

if (!isset($_SESSION["logged"])){
    $_SESSION["logged"] = false;
}
if (!isset($_SESSION["permissionLevel"])){
    $_SESSION["permissionLevel"] = 1;
}
if (!isset($_SESSION['LAST_ACTIVITY'])) {
    $_SESSION['LAST_ACTIVITY'] = time();
}
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
}

if (time() - $_SESSION['CREATED'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}


if(empty($_GET['page'])){
    $page = 'index';
} else {
    $url = explode("/", filter_var($_GET["page"], FILTER_SANITIZE_URL));
    $page = $url[0];
}

try{
    if(!$_SESSION["logged"]){
        //handle non-logged in pages
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
    } else {
        //is logged in and allow all pages
        switch ($page){
            case "index":
                $controller->loggedLanding();
                break;

            case "search":
                $controller->search();

            default:
                throw new Exception("La page n'existe pas - ". $page);
        }
    }
} catch(Exception $e){
    $page_description = "Page 404";
    $page_title = "Erreur";
    $page_content = $e->getMessage();
}
require_once("layouts/base.php");