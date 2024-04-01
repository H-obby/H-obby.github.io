<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST["name"];
    $email = $_POST["email"];
    $sujet = $_POST["sujet"];
    $message = $_POST["message"];

    if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {

        if (!preg_match("/^[a-zA-Z]*$/", $nom)) {
            $messageErreur = "Le nom ne doit contenir que des lettres.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $messageErreur = "L'adresse e-mail n'est pas valide.";
        }

        if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $sujet)) {
            $messageErreur = "Le sujet ne doit contenir que des lettres, des chiffres, des tirets et des espaces.";
        }

        if (!isset($messageErreur)) {

            $destinataire = "votre-email@example.com";
            $objet = "Demande d'assistance : $sujet";
            $corps = "Nom : $nom\nE-mail : $email\nSujet : $sujet\nMessage : $message";
            $enTetes = "From: $email";

            if (mail($destinataire, $objet, $corps, $enTetes)) {
                $messageSucces = "Votre demande d'assistance a été envoyée avec succès. Nous vous répondrons dans les plus brefs délais.";
            } else {
                $messageErreur = "Une erreur s'est produite lors de l'envoi de votre demande d'assistance. Veuillez réessayer plus tard.";
            }

        }

    } else {
        $messageErreur = "Veuillez remplir tous les champs obligatoires.";
    }

}

?>

<!DOCTYPE html>
<html>
<body>
    <center><h1>Page d'Assistance</h1></center>

    <?php if (isset($messageSucces)): ?>
        <p>
            <?php echo $messageSucces; ?>
        </p>
    <?php elseif (isset($messageErreur)): ?>
        <p>
            <?php echo $messageErreur; ?>
        </p>
    <?php endif; ?>
    <section>
        <div class="contact-intro">
            <h2>Contactez-nous</h2>
            <br>
            <p>Par Telephone : +33156615605 Sinon,</p>
            <br>
            <p>Si vous avez besoin d'aide supplémentaire, n'hésitez pas à nous contacter.</p>
            <br>
        </div>
        <form action="" method="post" class="contact-form">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required>
        <br>

        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" required>
        <br>

        <label for="sujet">Sujet :</label>
        <input type="text" name="sujet" id="sujet" required>
        <br>

        <label for="message">Message :</label>
        <textarea name="message" id="message" rows="5" required></textarea>
        <br>
        <br>
        <button type="submit" value="Envoyer" class="footer-auth button Content">Envoyer</button> 
        </form>
    </section>

    

</body>

</html>