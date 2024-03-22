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

  echo '
    <main class="visu-offre-stage-main">
      <div class="visu-offre-stage-container1">
        <div class="visu-offre-stage-container2">
          <div class="visu-offre-stage-container3">
            <ul class="visu-offre-stage-ul list">
              '.$fullHTMLTagList.'
            </ul>
            <div class="visu-offre-stage-container4">
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
            </div>
          </div>
        </div>
      </div>
      <div class="visu-offre-stage-main-text-content">
        <div class="visu-offre-stage-container5">
          <span class="visu-offre-stage-text06">'.$stageData["nom_entreprise"].'</span>
          <span class="visu-offre-stage-text07">Il y a '.$dateElapsed.'</span>
        </div>
        <h1 class="visu-offre-stage-text08">'.$stageData["titre"].'</h1>
        <span class="visu-offre-stage-text09">
          '.$stageData["description"].'
        </span>
      </div>
    </main>
  ';