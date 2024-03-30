<?php
    $controller = new MainController();
    $isCreation = !isset($_GET["stage_id"]);
    
    if(!$isCreation){
        $stageData = $controller->mainManager->getStageFromID($_GET["stage_id"])[0];
    
        if(isset($_POST["duree"])) $duree = $_POST["duree"];
        if(isset($_POST["promo_concernees"])) $promo_concernees = $_POST["promo_concernees"];
        if(isset($_POST["competences"])) $competences = $_POST["competences"];
        if(isset($_POST["remuneration"])) $remuneration = $_POST["remuneration"];
        if(isset($_POST["adresse"])) $adresse = $_POST["adresse"];
        if(isset($_POST["places_disponibles"])) $places_disponibles = $_POST["places_disponibles"];
        if(isset($_POST["nom_entreprise"])) $nom_entreprise = $_POST["nom_entreprise"];
        if(isset($_POST["titre"])) $titre = $_POST["titre"];
        if(isset($_POST["desc"])) $desc = $_POST["desc"];
    } else {
        $duree = "";
        $promo_concernees = "";
        $competences = "";
        $remuneration = "";
        $adresse = "";
        $places_disponibles = "";
        $nom_entreprise = "";
        $titre = "";
        $desc = "";
    }
?>

<form method="POST" class="modif-offre-stage-main">
    <div class="modif-offre-stage-container1">
        <div class="modif-offre-stage-form">
            <input type="text" name="duree"              value="<?= isset($duree) ? $duree : $stageData["duree"] ?>" placeholder="Durée" class="modif-offre-stage-dure input" />
            <input type="text" name="promo_concernees"   value="<?= isset($promo_concernees) ? $promo_concernees : $stageData["promo_concernees"] ?>" placeholder="Années concernées" class="modif-offre-stage-annes-concernes input" />
            <input type="text" name="competences"        value="<?= isset($competences) ? $competences : $stageData["competences"] ?>" placeholder="Compétences" class="modif-offre-stage-comptences input" />
            <input type="text" name="remuneration"       value="<?= isset($remuneration) ? $remuneration : $stageData["remuneration"] ?>" placeholder="Rémunération" class="modif-offre-stage-remun input" />
            <input type="text" name="adresse"            value="<?= isset($adresse) ? $adresse : $stageData["adresse"] ?>" placeholder="Adresse" autocomplete="false" class="modif-offre-stage-adresse input" />
            <input type="text" name="places_disponibles" value="<?= isset($places_disponibles) ? $places_disponibles : $stageData["places_disponibles"] ?>" placeholder="Nombre de places disponibles" class="modif-offre-stage-nb-place input" />
        </div>
        <div class="modif-offre-stage-container2">
            <button type="submit" name="poster" class="modif-offre-stage-button button">POSTER</button>
        </div>
    </div>
        <div class="modif-offre-stage-main-text-content">
            <div class="modif-offre-stage-container3">
                <input type="text" id="autocomplete" name="nom_entreprise" value="<?= isset($nom_entreprise) ? $nom_entreprise : $stageData["nom_entreprise"] ?>" placeholder="Nom d'Entreprise" class="modif-offre-stage-nom-entreprise input" />
                <script>
                    $("#autocomplete").autocomplete({
                        source: function(request, response) { 
                            $.ajax({
                                url:"function--getEntrepriseName",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    search: request.term
                                },
                                success: function(data){
                                    console.log(data);
                                    response(data);
                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                    console.log(errorThrown);
                                }
                            });
                        },
                        select: function (event, ui) {
                            $('#autocomplete').val(ui.item.value); // display the selected text
                        },
                    });
                </script>
            </div>
            <input type="text" name="titre" value="<?= isset($titre) ? $titre : $stageData["titre"] ?>" placeholder="Intitulé du Stage" class="modif-offre-stage-intitul-stage input" />
            <textarea placeholder="Description du Stage" name="desc" class="modif-offre-stage-textarea textarea"><?= isset($desc) ? $desc : $stageData["description"] ?></textarea>
        </div>
    </div>
</form>

<?php
if(isset($_POST["poster"])){
    //do the luigi
    if(!$isCreation){
        $answer = $controller->mainManager->updateStage($_GET["stage_id"], $_POST);
        if(!$answer){  
            echo '
            <script>
                let txt;
                if(confirm("L\'entreprise \"'.$_POST["nom_entreprise"].'\" n\'existe pas... \
                \nAppuyez sur OK pour la créer, n\'oubliez pas de la remplir par la suite.")){
                    let formData = new FormData();
                    formData.append("nom", "'.$_POST["nom_entreprise"].'");
                    fetch("function--createEmptyEntreprise", {method: "POST", body: formData})
                    .then(res => res.text())
                    .then(function(txt){
                        //redirect to new entreprise creation page
                        $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                            data: {
                                message: "L\'entreprise '.$_POST["nom_entreprise"].' a bien été créée.",
                                type: "success"
                            },
                            success: function(){
                                window.location.replace("modifStage&stage_id='.$_GET["stage_id"].'");
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                console.log(errorThrown);
                            }
                        });
                    })
                    .catch(err => console.error(err));
                } else {
                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                        data: {
                            message: "La modification n\'a pas pu être enregistrée...",
                            type: "danger"
                        },
                        success: function(){
                            window.location.replace("modifStage&stage_id='.$_GET["stage_id"].'");
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(errorThrown);
                        }
                    });
                }
            </script>
            ';
        } else {
            echo '
            <script>
                $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                    data: {
                        message: "La modification a correctement été effectuée!",
                        type: "success"
                    },
                    success: function(){
                        window.location.replace("affiche&offreID='.$_GET["stage_id"].'&t='.time().'");
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(errorThrown);
                    }
                });
            </script>
            ';
        }
    } else {
        $answer = $controller->mainManager->createStage($_POST);
        if($answer != "-1"){
            echo '
            <script>
                $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                    data: {
                        message: "La modification a correctement été effectuée!",
                        type: "success"
                    },
                    success: function(){
                        window.location.replace("affiche&offreID='.$answer.'&t='.time().'");
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(errorThrown);
                    }
                });
            </script>
            ';
        } else {
            echo '
            <script>
                let txt;
                if(confirm("L\'entreprise \"'.$_POST["nom_entreprise"].'\" n\'existe pas... \
                \nAppuyez sur OK pour la créer, n\'oubliez pas de la remplir par la suite.")){
                    let formData = new FormData();
                    formData.append("nom", "'.$_POST["nom_entreprise"].'");
                    fetch("function--createEmptyEntreprise", {method: "POST", body: formData})
                    .then(res => res.text())
                    .then(function(txt){
                        //redirect to new entreprise creation page
                        $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                            data: {
                                message: "L\'entreprise '.$_POST["nom_entreprise"].' a bien été créée.",
                                type: "success"
                            },
                            success: function(){
                                //thing
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                console.log(errorThrown);
                            }
                        });
                    })
                    .catch(err => console.error(err));
                } else {
                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                        data: {
                            message: "La modification n\'a pas pu être enregistrée...",
                            type: "danger"
                        },
                        success: function(){
                            //do nothing
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(errorThrown);
                        }
                    });
                }
            </script>
            ';
        }
    }
}
?>