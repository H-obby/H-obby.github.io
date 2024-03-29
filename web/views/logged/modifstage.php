<?php
    $controller = new MainController();

    $stageData = $controller->mainManager->getStageFromID($_GET["stage_id"])[0];

    if(isset($_POST["poster"])){
        //do the luigi
    }
?>

<form method="POST" class="modif-offre-stage-main">
    <div class="modif-offre-stage-container1">
        <div class="modif-offre-stage-form">
            <input type="text" value="<?= htmlspecialchars($stageData["duree"]) ?>" placeholder="Durée" class="modif-offre-stage-dure input" />
            <input type="text" value="<?= htmlspecialchars($stageData["promo_concernees"]) ?>" placeholder="Années concernées" class="modif-offre-stage-annes-concernes input" />
            <input type="text" value="<?= htmlspecialchars($stageData["competences"]) ?>" placeholder="Compétences" class="modif-offre-stage-comptences input" />
            <input type="text" value="<?= htmlspecialchars($stageData["remuneration"]) ?>" placeholder="Rémunération" class="modif-offre-stage-remun input" />
            <input type="text" value="<?= htmlspecialchars($stageData["adresse"]) ?>" placeholder="Adresse" autocomplete="false" class="modif-offre-stage-adresse input" />
            <input type="text" value="<?= htmlspecialchars($stageData["places_disponibles"]) ?>" placeholder="Nombre de places disponibles" class="modif-offre-stage-nb-place input" />
        </div>
        <div class="modif-offre-stage-container2">
            <button type="submit" name="poster" class="modif-offre-stage-button button">POSTER</button>
        </div>
    </div>
        <div class="modif-offre-stage-main-text-content">
            <div class="modif-offre-stage-container3">
                <input type="text" value="<?= $stageData["nom_entreprise"] ?>" placeholder="Nom d'Entreprise" class="modif-offre-stage-nom-entreprise input" />
            </div>
            <input type="text" value="<?= $stageData["titre"] ?>" placeholder="Intitulé du Stage" class="modif-offre-stage-intitul-stage input" />
            <textarea placeholder="Description du Stage" value="" class="modif-offre-stage-textarea textarea"><?= $stageData["description"] ?></textarea>
        </div>
    </div>
</form>