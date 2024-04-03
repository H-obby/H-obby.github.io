<?php
$controller = new MainController();
if(isset($_GET["stage_id"]) || (isset($_GET["type"]) && $_GET["type"] == "stage")){
    if($_SESSION["permissionLevel"] <= 1) header("Location: index");
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
        if(isset($_POST["domaine"])) $domaine = $_POST["domaine"];
        if(isset($_POST["titre"])) $titre = $_POST["titre"];
        if(isset($_POST["desc"])) $desc = $_POST["desc"];
    } else {
        $duree = "";
        $promo_concernees = "";
        $competences = "";
        $domaine = "";
        $remuneration = "";
        $adresse = "";
        $places_disponibles = "";
        $nom_entreprise = "";
        $titre = "";
        $desc = "";
    }
    

    echo '
    
    <form action="" method="POST" class="modif-offre-stage-main">
        <div class="modif-offre-stage-container1">
            <div class="modif-offre-stage-form">
                <input type="text" name="duree" pattern="^[0-9] mois$" title="Vous devez entrer le nombre de mois que dure le stage, puis le mot &quot;mois&quot;"
                value="'.(isset($duree) ? $duree : $stageData["duree"]).'" required
                placeholder="Durée" class="modif-offre-stage-dure input"/> 

                <input type="text" name="promo_concernees" pattern="^bac\+[0-9]$" title="Vous devez entrer &quot;bac+&quot; puis le nombre d\'années d\'études"
                value="'.(isset($promo_concernees) ? $promo_concernees : $stageData["promo_concernees"]).'" required
                placeholder="Années concernées" class="modif-offre-stage-annes-concernes input" />

                <input type="text" name="competences" required
                value="'.(isset($competences) ? $competences : $stageData["competences"]).'" 
                placeholder="Compétences" class="modif-offre-stage-comptences input" />

                <input type="text" name="remuneration" pattern="[0-9]+(?:\.[0-9]{1,2})?" title="Vous devez entrer un nombre, sans le signe € à la fin."
                value="'.(isset($remuneration) ? $remuneration : $stageData["remuneration"]).'" required
                placeholder="Rémunération" class="modif-offre-stage-remun input" />

                <input type="text" name="adresse" required
                value="'.(isset($adresse) ? $adresse : $stageData["adresse"]).'" 
                placeholder="Adresse" autocomplete="false" class="modif-offre-stage-adresse input" />

                <input type="text" name="places_disponibles" pattern="[0-9]+" title="Vous devez entrer un nombre." required
                value="'.(isset($places_disponibles) ? $places_disponibles : $stageData["places_disponibles"]).'" 
                placeholder="Nombre de places disponibles" class="modif-offre-stage-nb-place input" />

                <input type="text" name="domaine" required
                value="'.(isset($domaine) ? $domaine : $stageData["domaine"]).'" 
                placeholder="Domaine d\'activité du stage" class="modif-offre-stage-nb-place input" />
            </div>
            <div class="modif-offre-stage-container2">
                <button type="submit" name="poster" class="modif-offre-stage-button button">POSTER</button>
            </div>
        </div>
            <div class="modif-offre-stage-main-text-content">
                <div class="modif-offre-stage-container3">
                    <input type="text" id="autocomplete" name="nom_entreprise" value="'.(isset($nom_entreprise) ? $nom_entreprise : $stageData["nom_entreprise"]).'" placeholder="Nom d\'Entreprise" class="modif-offre-stage-nom-entreprise input" required/>
                    <script>
                        $("#autocomplete").autocomplete({
                            source: function(request, response) { 
                                $.ajax({
                                    url:"function--getEntrepriseName",
                                    type: \'post\',
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
                                $(\'#autocomplete\').val(ui.item.value); // display the selected text
                            },
                        });
                    </script>
                </div>
                <input type="text" name="titre" value="'.(isset($titre) ? $titre : $stageData["titre"]).'" placeholder="Intitulé du Stage" class="modif-offre-stage-intitul-stage input" required/>
                <textarea placeholder="Description du Stage" name="desc" class="modif-offre-stage-textarea textarea" required>'.(isset($desc) ? $desc : $stageData["description"]).'</textarea>
            </div>
        </div>
    </form>
    ';

    if(isset($_POST["poster"])){
        //do the luigi
        if(!$isCreation){
            $answer = $controller->mainManager->updateStage($_GET["stage_id"], $_POST);
            if(!$answer){  
                echo '
                <script>
                    let txt;
                    if(confirm("L\'entreprise &quot;'.$_POST["nom_entreprise"].'&quot; n\'existe pas... \
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
                    if(confirm("L\'entreprise &quot;'.$_POST["nom_entreprise"].'&quot; n\'existe pas... \
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
} else if (isset($_GET['entreprise_id']) ||  (isset($_GET["type"]) && $_GET["type"] == "entreprise")){
    if($_SESSION["permissionLevel"] <= 1) header("Location: index");
    $isCreation = !isset($_GET["entreprise_id"]);

    if(!$isCreation){
        $entrepriseData = $controller->mainManager->getEntrepriseFromID($_GET["entreprise_id"])[0];
    } else {
        $secteur = "";
        $addresse_siege = "";
        $mail = "";
        $nom = "";
        $desc = "";
        $logo = "";
    }
    
    if(isset($_POST["secteur"])) $secteur = $_POST["secteur"];
    if(isset($_POST["addresse_siege"])) $adresse_siege = $_POST["addresse_siege"];
    if(isset($_POST["mail"])) $contact = $_POST["mail"];
    if(isset($_POST["nom"])) $nom = $_POST["nom"];
    if(isset($_POST["desc"])) $desc = $_POST["desc"];
    if(isset($_POST["logo"])) $logo = $_POST["logo"];
    
    echo '
    <form action="" method="POST" class="modif-offre-stage-main">
        <div class="modif-offre-stage-container1">
            <div class="modif-offre-stage-form">
                <input type="text" id="autocomplete" name="secteur" required
                value="'.(isset($secteur) ? $secteur : $entrepriseData["secteur"]).'" 
                placeholder="Secteur d\'activité de l\'entreprise" class="modif-offre-stage-nb-place input"/>
                <script>
                    $("#autocomplete").autocomplete({
                        source: function(request, response) { 
                            $.ajax({
                                url:"function--ajaxGetSecteur",
                                type: \'post\',
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
                            $(\'#autocomplete\').val(ui.item.value); // display the selected text
                        },
                    });
                </script>
                
                <input type="text" id="addr" name="addresse_siege" required
                value="'.(isset($addresse_siege) ? $addresse_siege : $entrepriseData["addresse_siege"]).'" 
                placeholder="Adresse du siège de l\'entreprise" class="modif-offre-stage-nb-place input"/>
                
                <input type="text" id="mail" name="mail" required
                value="'.(isset($mail) ? $mail : $entrepriseData["mail"]).'" 
                placeholder="Adresse mail de l\'entreprise" class="modif-offre-stage-nb-place input"/>

                <img alt="Logo de l\'entreprise" id="img" src="'.URL.'public/'.(isset($logo) ? $logo : $entrepriseData["logo"]).'" class="modif-etudiant-image" />
                <button type="file" id="modifierImage" name="logo" accept="image/*" class="modif-etudiant-button button">Modifier le logo</button>
            </div>
            <div class="modif-offre-stage-container2">
                <button type="submit" name="poster" class="modif-offre-stage-button button">POSTER</button>
            </div>
        </div>
            <div class="modif-offre-stage-main-text-content">
                <input type="text" name="nom" id="name"
                value="'.(isset($nom) ? $nom : $entrepriseData["nom"]).'" 
                placeholder="Intitulé du Stage" class="modif-offre-stage-intitul-stage input" required/>

                <textarea placeholder="Description du Stage" name="desc" id="desc"
                class="modif-offre-stage-textarea textarea" 
                required>'.(isset($desc) ? $desc : $entrepriseData["description"]).'
                </textarea>
            </div>
        </div>
    </form>
    ';

    if(isset($_POST["poster"])){
        //do the luigi
        if(!$isCreation){
            $answer = $controller->mainManager->updateEntreprise($_GET["entreprise_id"], $_POST);
            if(!$answer){  
                echo '
                <script>
                    let txt;
                    if(confirm("Le secteur d\'activité &quot;'.$_POST["secteur"].'&quot; n\'existe pas dans notre base de donnée... \
                    \nAppuyez sur OK pour le rajouter.")){
                        $.ajax({type: "POST", url: "function--ajaxCreationSecteur",
                            data: {
                                secteur: '.$_POST["secteur"].'
                            },
                            success: function(){

                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                console.log(errorThrown);
                            }
                        });
                    } else {
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
                            window.location.replace("affiche&entrepriseID='.$_GET["entreprise_id"].'&t='.time().'");
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(errorThrown);
                        }
                    });
                </script>
                ';
            }
        } else {
            $answer = $controller->mainManager->createEntreprise($_POST);
            if(!is_array($answer)){
                echo '
                <script>
                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                        data: {
                            message: "La création a correctement été effectuée!",
                            type: "success"
                        },
                        success: function(){
                            window.location.replace("affiche&entrepriseID='.$answer.'&t='.time().'");
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(errorThrown);
                        }
                    });
                </script>
                ';
            } else {
                print_r($answer);
                echo '
                <script>
                let txt;
                    if(confirm("Le secteur d\'activité \"'.$answer[1].'\" n\'existe pas dans notre base de donnée... \
                    \nAppuyez sur OK pour le rajouter.")){
                        $.ajax({type: "POST", url: "function--ajaxCreateSecteur",
                            data: {
                                secteur: "'.$answer[1].'"
                            },
                            success: function(){

                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                console.log(errorThrown);
                            }
                        });
                    } else {
                    }
                </script>
                ';
            }
        }
    }
} else if (isset($_GET['user_id']) ||  (isset($_GET["type"]) && $_GET["type"] == "utilisateur")){
    if($_SESSION["permissionLevel"] <= 1) header("Location: index");
    $isCreation = !isset($_GET["user_id"]);
    
    if(!$isCreation){
        $userData = $controller->mainManager->getUserFromID($_GET["user_id"])[0];
    
        if(isset($_POST["name"])) $name = $_POST["name"];
        if(isset($_POST["surname"])) $surname = $_POST["surname"];
        if(isset($_POST["promo"])) $promoCode = $_POST["promo"];
        if(isset($_POST["centre"])) $centre = $_POST["centre"];
        if(isset($_POST["image"])) $image = $_POST["image"];
        if(isset($_POST["login"])) $login = $_POST["login"];
    } else {
        $name = "";
        $surname = "";
        $promoCode = "";
        $centre = "";
        $image = "";
        $password = "";
        $login = "";
    }
    echo '
    <form class="modif-etudiant-main" method="POST">
        <div class="modif-etudiant-container1">
            <img alt="Photo de profil de l\'utilisateur" src="'.URL.'public/'.(isset($image) ? $image : $userData["pfp"]).'" class="modif-etudiant-image" />
            <button type="button" id="modifierImage" class="modif-etudiant-button button">Modifier l\'image</button>
            <hidden type="input" name="imagePath" value="'.URL.'public/'.(isset($image) ? $image : $userData["pfp"]).'"/>
            <button type="submit" name="poster" class="modif-etudiant-button1 button">POSTER</button>
        </div>
        <div class="modif-etudiant-main-text-content">
            <div class="modif-etudiant-container2">
                <input name="name" type="text" placeholder="Nom de l\'étudiant"
                    class="modif-etudiant-nom-etudiant input" pattern="[a-zA-Z\s,\',]+" value="'.(isset($name) ? $name : $userData["name"]).'"/>
                <input name="surname" type="text" placeholder="Prénom de l\'étudiant"
                    class="modif-etudiant-prenom-etudiant input" pattern="[a-zA-Z\s,\',]+" value="'.(isset($surname) ? $surname : $userData["surname"]).'"/>
            </div>
            <div class="modif-etudiant-form">
                <input type="text" name="promo" id="promo" placeholder="Promotion" class="modif-etudiant-promo input" pattern="[a-zA-Z0-9\s,\',]+" value="'.(isset($promoCode) ? $promoCode : $userData["promo"]).'"/>
                <input type="text" name="centre" id="centre" placeholder="Centre" class="modif-etudiant-centre input" pattern="[a-zA-Z\s,\',]+" value="'.(isset($centre) ? $centre : $userData["centre"]).'"/>
                <script>
                    $("#promo").autocomplete({
                        source: function(request, response) { 
                            $.ajax({
                                url:"function--ajaxGetPromoCode",
                                type: \'post\',
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
                            $(\'#promo\').val(ui.item.label); // display the selected text
                            $(\'#centre\').val(ui.item.centre);
                        },
                    });

                    '.(!$isCreation ? "function changePassword(){
                        document.getElementById(\"changePass\").style = \"display:none;\"
                        document.getElementById(\"passInput\").style = \"display:flex;\"
                    }" : "").'
                </script>
                <input type="text" name="login" placeholder="Email" class="modif-etudiant-promo input" value="'.(isset($login) ? $login : $userData["login"]).'"/>
                <input type="password" name="pass" id="passInput" placeholder="Mot de Passe" 
                class="modif-etudiant-promo input" 
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                title = "Le mot de passe doit avoir une longueur supérieure à 8 caractères\nComporter au moins un chiffre\nComporter au moins un caractère spécial"
                value="" '.($isCreation ? "" : "style=\"display:none;\"").'/>
                <button type="button" id="changePass" name="passwordChange" onclick="changePassword()" class="modif-etudiant-button1 button" '.($isCreation ? "style=\"display:none;\"" : "style=\"cursor:pointer;\"").'>CHANGER LE MOT DE PASSE</button>
            </div>
        </div>
    </form> 
    ';

    if(isset($_POST["poster"])){
        //do the luigi
        if(!$isCreation){
            $answer = $controller->mainManager->updateUser($_GET["user_id"], $_POST);
            if(!$answer){  
                echo '
                <script>
                    if(confirm("La promotion '.$_POST["promo"].' n\'existe pas... \
                    \nVoulez-vous la créer ?")){
                        let promoName = prompt("Veuillez entrer le nom de la promo", "A1 Généraliste");
                        let centre = prompt("Veuillez entrer le centre de la promo", "Lille");
                        if(promoName != null && promoName != "" && centre != null && centre != ""){
                            $.ajax({type: "POST", url: "function--ajaxCreationCentre",
                                data: {
                                    promo: '.$_POST["promo"].'
                                    display: promoName,
                                    centre: centre
                                },
                                success: function(){
                                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                                        data: {
                                            message: "La promotion a bien été créée.",
                                            type: "success"
                                        },
                                        success: function(){
                                            
                                        },
                                        error: function(jqXHR, textStatus, errorThrown){
                                            console.log(errorThrown);
                                        }
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                    console.log(errorThrown);
                                }
                            });
                        }
                    } else {
                        $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                            data: {
                                message: "La modification n\'a pas pu être enregistrée...",
                                type: "danger"
                            },
                            success: function(){
                                window.location.replace("modification&user_id='.$_GET["user_id"].'");
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
                            window.location.replace("affiche&userID='.$_GET["user_id"].'&t='.time().'");
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(errorThrown);
                        }
                    });
                </script>
                ';
            }
        } else {
            $answer = $controller->mainManager->createUser($_POST);
            if($answer != "-1"){
                echo '
                <script>
                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                        data: {
                            message: "La création a correctement été effectuée!",
                            type: "success"
                        },
                        success: function(){
                            window.location.replace("affiche&userID='.$answer.'&t='.time().'");
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
                    if(confirm("La promotion '.$_POST["promo"].' n\'existe pas... \
                    \nVoulez-vous la créer ?")){
                        let promoName = prompt("Veuillez entrer le nom de la promo", "A1 Généraliste");
                        let centre = prompt("Veuillez entrer le centre de la promo", "Lille");
                        if(promoName != null && promoName != "" && centre != null && centre != ""){
                            $.ajax({type: "POST", url: "function--ajaxCreationCentre",
                                data: {
                                    promo: "'.$_POST["promo"].'",
                                    display: promoName,
                                    centre: centre
                                },
                                success: function(){
                                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                                        data: {
                                            message: "La promotion a bien été créée.",
                                            type: "success"
                                        },
                                        success: function(){
                                            window.location.replace("index&t='.time().'");
                                        },
                                        error: function(jqXHR, textStatus, errorThrown){
                                            console.log(errorThrown);
                                        }
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                    console.log(errorThrown);
                                }
                            });
                        }
                    } else {
                        $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                            data: {
                                message: "La création n\'a pas pu être enregistrée...",
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
} else if (isset($_GET['tuteur_id']) ||  (isset($_GET["type"]) && $_GET["type"] == "tuteur")){
    if($_SESSION["permissionLevel"] <= 2) header("Location: index");
    $isCreation = !isset($_GET["tuteur_id"]);
    
    if(!$isCreation){
        $userData = $controller->mainManager->getUserFromID($_GET["tuteur_id"])[0];
        $promos = $controller->mainManager->getAllTuteurPromos($_GET["tuteur_id"]);
    
        if(isset($_POST["name"])) $name = $_POST["name"];
        if(isset($_POST["surname"])) $surname = $_POST["surname"];
        if(isset($_POST["promos"])) $promos = $_POST["promos"];
        if(isset($_POST["centre"])) $centre = $_POST["centre"];
        if(isset($_POST["image"])) $image = $_POST["image"];
        if(isset($_POST["login"])) $login = $_POST["login"];
    } else {
        $name = "";
        $surname = "";
        $promos = [];
        $centre = "";
        $image = "";
        $password = "";
        $login = "";
    }

    $allPromos = "";
    foreach($promos as $promo){
        if(is_string($promo)){
            $allPromos .= '
            <script> addPromo("'.$promo.'") </script>';
        } else {
            $allPromos .= '
            <script> addPromo("'.$promo["promo"].'") </script>';
        }
    }

    echo '

    <script>
    function SearchText() {
        $(".modif-tuteur-promo").autocomplete({
            source: function(request, response) { 
                $.ajax({
                    url:"function--ajaxGetPromoCode",
                    type: \'post\',
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

            },
        });
    }
    
    function addPromo(laPromo = "") {
        var div = document.createElement("div");
        div.setAttribute("class", "modif-etudiant-container2");
        div.innerHTML = 
        `
            <input type="text" name="promos[]" placeholder="Promotion" class="modif-tuteur-promo input" value="${laPromo}" />
        `;
        document.getElementById("allPromos").appendChild(div);
        SearchText();
    }

    function removePromo(){
        document.querySelectorAll(\'#allPromos > div:nth-last-child(-n+1)\').forEach(n => {
            n.parentNode.removeChild(n)
        });
        SearchText();
    }
    </script>
    
    <form class="modif-etudiant-main" method="POST">
        <div class="modif-etudiant-container1">
            <img alt="Photo de profil de l\'utilisateur" src="'.URL.'public/'.(isset($image) ? $image : $userData["pfp"]).'" class="modif-etudiant-image" />
            <button type="button" name="modifierImage" class="modif-etudiant-button button">Modifier l\'image</button>
            <hidden type="input" name="imagePath" value="'.URL.'public/'.(isset($image) ? $image : $userData["pfp"]).'"/>
            <button type="button" onclick="addPromo()" name="addPromotion" class="modif-etudiant-button button">Ajouter une promo</button>
            <button type="button" onclick="removePromo()" name="suppPromo" class="modif-etudiant-button button">Supprimer une promo</button>
            <button type="submit" name="poster" class="modif-etudiant-button1 button">POSTER</button>
        </div>
        <div class="modif-etudiant-main-text-content">
            <div class="modif-etudiant-container2">
                <input name="name" type="text" placeholder="Nom du tuteur"
                    class="modif-etudiant-nom-etudiant input" pattern="[a-zA-Z\s,\',]+" value="'.(isset($name) ? $name : $userData["name"]).'"/>
                <input name="surname" type="text" placeholder="Prénom du tuteur"
                    class="modif-etudiant-prenom-etudiant input" pattern="[a-zA-Z\s,\',]+" value="'.(isset($surname) ? $surname : $userData["surname"]).'"/>
            </div>
            <div id="allPromos" class="modif-etudiant-form">
            '.$allPromos.'
            </div>
                <script>
                    '.(!$isCreation ? "function changePassword(){
                        document.getElementById(\"changePass\").style = \"display:none;\"
                        document.getElementById(\"passInput\").style = \"display:flex;\"
                    }" : "").'
                </script>
                <input type="text" name="login" placeholder="Email" class="modif-etudiant-promo input" value="'.(isset($login) ? $login : $userData["login"]).'"/>
                <input type="password" name="pass" id="passInput" placeholder="Mot de Passe" class="modif-etudiant-promo input" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" value="" '.($isCreation ? "" : "style=\"display:none;\"").'/>
                <button type="button" id="changePass" name="passwordChange" onclick="changePassword()" class="modif-etudiant-button1 button" '.($isCreation ? "style=\"display:none;\"" : "style=\"cursor:pointer;\"").'>CHANGER LE MOT DE PASSE</button>
            </div>
        </div>
    </form> 
    ';

    if(isset($_POST["poster"])){
        //do the luigi
        if(!$isCreation){
            $answer = $controller->mainManager->updateTuteur($_GET["tuteur_id"], $_POST);
            if(!is_bool($answer)){  
                echo '
                <script>
                    alert("La promotion '.$answer.' n\'existe pas.\nVeuillez y assigner un élève pour continuer.")
                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                        data: {
                            message: "La modification n\'a pas pu être enregistrée...",
                            type: "danger"
                        },
                        success: function(){
                            window.location.replace("modification&tuteur_id='.$_GET["tuteur_id"].'");
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
                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                        data: {
                            message: "La modification a correctement été effectuée!",
                            type: "success"
                        },
                        success: function(){
                            window.location.replace("affiche&tuteurID='.$_GET["tuteur_id"].'&t='.time().'");
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(errorThrown);
                        }
                    });
                </script>
                ';
            }
        } else {
            $answer = $controller->mainManager->createTuteur($_POST);
            if(!is_array($answer)){
                echo '
                <script>
                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                        data: {
                            message: "La création a correctement été effectuée!",
                            type: "success"
                        },
                        success: function(){
                            window.location.replace("affiche&tuteurID='.$answer.'&t='.time().'");
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
                    if(confirm("La promotion '.$answer[1].' n\'existe pas... \
                    \nVoulez-vous la créer ?")){
                        let promoName = prompt("Veuillez entrer le nom de la promo", "A1 Généraliste");
                        let centre = prompt("Veuillez entrer le centre de la promo", "Lille");
                        if(promoName != null && promoName != "" && centre != null && centre != ""){
                            $.ajax({type: "POST", url: "function--ajaxCreationCentre",
                                data: {
                                    promo: "'.$answer[1].'"
                                    display: promoName,
                                    centre: centre
                                },
                                success: function(){
                                    $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                                        data: {
                                            message: "La promotion a bien été créée.",
                                            type: "success"
                                        },
                                        success: function(){
                                            window.location.replace("index&t='.time().'");
                                        },
                                        error: function(jqXHR, textStatus, errorThrown){
                                            console.log(errorThrown);
                                        }
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                    console.log(errorThrown);
                                }
                            });
                        }
                    } else {
                        $.ajax({type: "POST", url: "function--ajaxHandleAlert", 
                            data: {
                                message: "La création n\'a pas pu être enregistrée...",
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
}