<?php
session_cache_limiter('private_no_expire');
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http").
    "://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]));

require_once("controllers/MainController.php");
$controller = new MainController();

if (isset($_SESSION['CREATED']) && time() - $_SESSION['CREATED'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    session_start();
}

if (!isset($_SESSION["logged"])){
    $_SESSION["logged"] = false;
}
if (!isset($_SESSION["loggedAs"])){
    $_SESSION["loggedAs"] = "";
}
if (!isset($_SESSION["permissionLevel"])){
    $_SESSION["permissionLevel"] = 1;
}
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
}



if(empty($_GET['page'])){
    $page = 'index';
} else {
    $url = explode("/", filter_var($_GET["page"], FILTER_SANITIZE_URL));
    $page = $url[0];
}

try{
    if(str_starts_with($page, "function--")){
        $func = str_replace("function--","", $page);
        $controller->$func($_POST);
        die;
    }

    if(!$_SESSION["logged"] || !$_SESSION["loggedAs"]){
        //handle non-logged in pages
        switch ($page){
            case "index":
                $controller->index();
                break;

            case "login":
                $controller->login();
                break;

            case "search" | "affiche":
                $controller->index();
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
                break;

            case "affiche":
                $controller->affiche();
                break;

            case "wishlist":
                $controller->wishlist();
                break;

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