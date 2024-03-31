<?php
  function humanTiming ($time)
  {
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
      31536000 => 'année',
      2592000 => 'mois',
      604800 => 'semaine',
      86400 => 'jour',
      3600 => 'heure',
      60 => 'minute',
      1 => 'seconde'
    );

    foreach ($tokens as $unit => $text) {
      if ($time < $unit) continue;
      $numberOfUnits = floor($time / $unit);
      return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
  }

  $isStage = false;
  $isEntreprise = false;
  $isUser = false;
  $isTuteur = false;
  if(isset($_GET["offreID"])) $isStage = true;
  if(isset($_GET["userID"])) $isUser = true;
  if(isset($_GET["entrepriseID"])) $isEntreprise = true;
  if(isset($_GET["tuteurID"])) $isTuteur = true;
  
  if($isStage){
    $controller = new MainController();
    $stageData = $controller->mainManager->getStageFromID($_GET['offreID'])[0];
  
    /*
    stage.titre, stage.competences, stage.adresse, stage.promo_concernees,
    stage.remuneration, stage.date_offre, stage.places_disponibles, stage.description, stage.duree,
    entreprise.nom as nom_entreprise
    */
  
    $thingList = [
      "Domaine principal"=> $stageData["promo_concernees"],
      "Compétences"=> $stageData["competences"],
      "Durée" => $stageData["duree"],
      "Rémunération" => $stageData["remuneration"],
      "Places disponibles"=> $stageData["places_disponibles"],
      "Adresse" => $stageData["adresse"],
    ];
  
    $fullHTMLTagList = '';
    foreach( $thingList as $key => $data) {
      $fullHTMLTagList .= '
        <li class="visu-offre-stage-li tagListItem">
          <span class="visu-offre-stage-text">'.$key.' :</span>
          <span>'.$data.'</span>
        </li>
      ';
    }
  
    $datePostee = new DateTime($stageData["date_offre"]);
    $dateElapsed = humanTiming(strtotime($datePostee->format("Y-m-d H:i:s")));
    $jsonDesc = json_encode($stageData["description"]);
    echo '
      <main class="visu-offre-stage-main">
        <div class="visu-offre-stage-container1">
          <div class="visu-offre-stage-container2">
            <div class="visu-offre-stage-container3">
              <ul class="visu-offre-stage-ul list">
                '.$fullHTMLTagList.'
              </ul>
              <form class="visu-offre-stage-container4">
                <button type="button" class="visu-offre-stage-button button">
                  POSTULER
                </button>
                <button type="button" class="visu-offre-stage-button1 button">
                  <img
                    alt="image"
                    src="../public/bookmark-svgrepo-com.svg"
                    class="visu-offre-stage-image"
                  />
                </button>
              </form>
              <form action="modification&stage_id='.$_GET["offreID"].'" class="visu-offre-stage-container5">
                <button type="submit" class="visu-offre-stage-button2 button">
                  MODIFIER
                </button>
              </form>
              <form onsubmit="areYouSure()" action="" class="visu-offre-stage-container5">
                <button type="submit" class="visu-offre-stage-button2 button">
                  SUPPRIMER
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="visu-offre-stage-main-text-content">
          <div class="visu-offre-stage-container5">
            <span class="visu-offre-stage-text06">'.$stageData["nom_entreprise"].'</span>
            <span class="visu-offre-stage-text07">Il y a '.$dateElapsed.'</span>
          </div>
          <h1 class="visu-offre-stage-text08">'.$stageData["titre"].'</h1>
          <span id="desc" class="visu-offre-stage-text09"></span>
          <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
          <script>
            document.getElementById("desc").innerHTML =
            marked.parse('.$jsonDesc.');
          </script>
        </div>
      </main>
  
      <script>
        function areYouSure(){
          if(confirm("Voulez-vous vraiment supprimer le stage \"'.$stageData["titre"].'\" ?")){
            $.ajax({type: "POST", url: "function--ajaxRemoveStage", 
              data: {
                id:'.$_GET["offreID"].'
              },
              success: function(){
                window.location.replace("index&t='.time().'");
              },
              error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown);
              }
            });
          } else {
  
          }
        }
      </script>
    ';
  } else if ($isUser){
    $controller = new MainController();
    $userData = $controller->mainManager->getUserFromID($_GET['userID'])[0];
    echo '
      <main class="visu-etudiant-main">
          <div class="visu-offre-stage-container1">
            <div class="visu-offre-stage-container2">
              <div class="visu-offre-stage-container3">
                <form action="modification&user_id='.$_GET["userID"].'" class="visu-offre-stage-container5">
                  <button type="submit" class="visu-offre-stage-button2 button">
                    MODIFIER
                  </button>
                </form>
                <form onsubmit="areYouSure()" action="" class="visu-offre-stage-container5">
                  <button type="submit" class="visu-offre-stage-button2 button">
                    SUPPRIMER
                  </button>
                </form>
              </div>
            </div>
          </div>
        <img
          alt="Photo de profil d\''.$userData["surname"].' '.$userData["name"].'"
          src="'.URL.'public/'.$userData["pfp"].'"
          class="visu-etudiant-image"
        />
        <div class="visu-etudiant-main-text-content">
          <h1 class="visu-etudiant-text">'.$userData["surname"].' '.$userData["name"].'</h1>
          <ul class="visu-etudiant-ul list">
            <li class="visu-etudiant-li list-item">
              <span class="visu-etudiant-first">Promotion :</span>
              <span>'.$userData["promo"].', '.$userData["promoName"].'</span>
            </li>
            <li class="visu-etudiant-li1 list-item">
              <span class="visu-etudiant-first1">Centre :</span>
              <span>'.$userData["centre"].'</span>
            </li>
          </ul>
          '/*<h1 class="visu-etudiant-text1">Historique des Stages</h1>
          <ul class="visu-etudiant-ul1 list">
            <li class="visu-etudiant-li2 list-item">
              <span class="visu-etudiant-first2">15/04/2024 - 14/08/2024 :</span>
              <span class="visu-etudiant-second2">ArcelorMittal DUNKERQUE</span>
            </li>
          </ul>*/.'
        </div>
        <script>
          function areYouSure(){
            if(confirm("Voulez-vous vraiment supprimer le compte de '.$userData["name"].' '.$userData["surname"].' ?")){
              $.ajax({type: "POST", url: "function--ajaxRemoveUser", 
                data: {
                  id: '.$_GET["userID"].'
                },
                success: function(){
                  window.location.replace("index&t='.time().'");
                },
                error: function(jqXHR, textStatus, errorThrown){
                  console.log(errorThrown);
                }
              });
            } else {
    
            }
          }
        </script>
      </main>
    ';
  } else if ($isEntreprise){

  } else if ($isTuteur){
    $controller = new MainController();
    $userData = $controller->mainManager->getUserFromID($_GET['tuteurID'])[0];

    $HTMLPromoList = "";
    $HTMLCentreList = "";
    $promos = $controller->mainManager->getAllTuteurPromos($_GET["tuteurID"]);
    foreach ($promos as $promo){
      $HTMLPromoList .= '
      <li class="visu-etudiant-li list-item">
        <span>'.$promo["promo"].', '.$promo["displayName"].', '.$promo["centre"].'</span>
      </li>
      ';

      if(strstr($HTMLCentreList, '<span>'.$promo["centre"].'</span>') === false){
        $HTMLCentreList .= '
        <li class="visu-etudiant-li1 list-item">
          <span class="visu-etudiant-first1">Centre :</span>
          <span>'.$promo["centre"].'</span>
        </li>';
      } ;
    }

    echo '
      <main class="visu-etudiant-main">
          <div class="visu-offre-stage-container1">
            <div class="visu-offre-stage-container2">
              <div class="visu-offre-stage-container3">
                <form action="modification&tuteur_id='.$_GET["tuteurID"].'" class="visu-offre-stage-container5">
                  <button type="submit" class="visu-offre-stage-button2 button">
                    MODIFIER
                  </button>
                </form>
                <form onsubmit="areYouSure()" action="" class="visu-offre-stage-container5">
                  <button type="submit" class="visu-offre-stage-button2 button">
                    SUPPRIMER
                  </button>
                </form>
              </div>
            </div>
          </div>
        <img
          alt="Photo de profil d\''.$userData["surname"].' '.$userData["name"].'"
          src="'.URL.'public/'.$userData["pfp"].'"
          class="visu-etudiant-image"
        />
        <div class="visu-etudiant-main-text-content">
          <h1 class="visu-etudiant-text">'.$userData["surname"].' '.$userData["name"].'</h1>
          <ul class="visu-etudiant-ul list">
            <h1 class="visu-etudiant-text"> Gère les promos : </h1>
            '.$HTMLPromoList.'
            <br/>
            <h1 class="visu-etudiant-text"> Basé sur le centre de : </h1>
            '.$HTMLCentreList.'
          </ul>
        </div>
        <script>
          function areYouSure(){
            if(confirm("Voulez-vous vraiment supprimer le compte de '.$userData["name"].' '.$userData["surname"].' ?")){
              $.ajax({type: "POST", url: "function--ajaxRemoveUser", 
                data: {
                  id: '.$_GET["tuteurID"].'
                },
                success: function(){
                  window.location.replace("index&t='.time().'");
                },
                error: function(jqXHR, textStatus, errorThrown){
                  console.log(errorThrown);
                }
              });
            } else {
    
            }
          }
        </script>
      </main>
    ';
  }
