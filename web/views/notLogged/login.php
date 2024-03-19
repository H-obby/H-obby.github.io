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
    if(isset($_POST["username"]) && isset( $_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($username == "admin" && $password == "admin"){
            $_SESSION["logged"] = true;
            $_SESSION["permissionLevel"] = 2;
            header("Location: index");
        } else {
            echo "Mauvais nom d'utilisateur ou mot de passe";
        }
    }
?>