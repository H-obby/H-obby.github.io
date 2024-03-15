<?php

if(empty($_GET['page'])){
    $page = 'index';
} else {
    $url = explode("/", filter_var($_GET["page"], FILTER_SANITIZE_URL));
    $page = $url[0];
}

try{
    switch ($page){
        case "index":
            $page_description = "Page d'accueil";
            $page_title = "Page d'accueil";
            $page_content = "
            <link href=\"./styles/index.css\" rel=\"stylesheet\" />
            <div class=\"index-hero\">
                <span class=\"index-text\">La recherche de stage simplifiée</span>
                <h1 class=\"index-text1\">
                    Où l'éducation rencontre l'expérience, pour un avenir professionnel brillant.
                </h1>
                <a href=\"login\" class=\"index-navlink button\"> S'authentifier </a>
            </div>
            ";
            break;

        case "login":
            $page_description = "login";
            $page_title = "login";
            $page_content = "
            <link href=\"./styles/login-page.css\" rel=\"stylesheet\" />
            <div class=\"login-page-login-page\">
                <h1 class=\"login-page-text\">
                <span>Connection</span>
                <br />
                </h1>
                <form class=\"login-page-form\" method=\"post\">
                <input
                    type=\"text\"
                    placeholder=\"Nom d'utilisateur\"
                    class=\"login-page-username input\"
                />
                <input
                    type=\"password\"
                    placeholder=\"Mot de passe\"
                    class=\"login-page-password input\"
                />
                </form>
                <a href=\"logged-in-landing.html\" class=\"login-page-navlink button\">
                Se connecter
                </a>
            </div>
            ";
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
?>