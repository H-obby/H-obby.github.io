<div class="login-page-login-page">
  <h1 class="login-page-text">
    <span>Connection</span>
    <br />
  </h1>
  <form class="login-page-form" action="" method="post">
    <input name="username" type="text" placeholder="Nom d'utilisateur" class="login-page-username input" />
    <input name="password" type="password" placeholder="Mot de passe" class="login-page-password input" />
    <input type="submit" value="Se connecter" class="login-page-navlink button" />
  </form>
</div> 

<?php
    require_once("controllers/Database.php");

    if(isset($_POST["login"]) && isset( $_POST["password"])){
        $login = $_POST["login"];
        $encryptedPassword = hash("sha256", $_POST["password"]);
        if($encryptedPassword == getMDP($login)["mot_de_passe"]){
            $_SESSION["logged"] = true;
            $_SESSION["permissionLevel"] = 2;
            header("Location: index");
        } else {
            echo "Mauvais nom d'utilisateur ou mot de passe";
        }
    }
?>