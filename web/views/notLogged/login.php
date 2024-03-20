<div class="login-page-login-page">
  <h1 class="login-page-text">
    <span>Connection</span>
    <br />
  </h1>
  <form class="login-page-form" action="" method="post">
    <input name="login" type="text" placeholder="Adresse Mail" class="login-page-username input" />
    <input name="password" type="password" placeholder="Mot de passe" class="login-page-password input" />
    <input type="submit" value="Se connecter" class="login-page-navlink button" />
  </form>
</div> 

<?php
    require_once("controllers/MainManager.php");

    $manager = new MainManager();

    if(isset($_POST["login"]) && isset( $_POST["password"])){
        $login = $_POST["login"];
        $encryptedPassword = hash("sha256", $_POST["password"]);
        if($encryptedPassword == $manager->getMDP($login)["mot_de_passe"]){
            $_SESSION["logged"] = true;
            $_SESSION["loggedAs"] = $login;
            $_SESSION["permissionLevel"] = $manager->getPermissionLevel($login)["type"];
            header("Location: index");
        } else if($encryptedPassword == $manager->getMDPAdmin($login)[0]["mot_de_passe"]){
            $_SESSION["logged"] = true;
            $_SESSION["loggedAs"] = $login;
            $_SESSION["permissionLevel"] = 3;
            header("Location: index");
        } else {
            echo "Mauvais nom d'utilisateur ou mot de passe";
        }
    }
?>