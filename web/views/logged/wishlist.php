<?php
$controller = new MainController();

function humanTiming($time)
{
    $time = time() - $time; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
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
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}

foreach ($datas["stages"] as &$stageContainer) {
    $stageData = $controller->mainManager->getStageFromID($stageContainer["id_stage"])[0];
    $desc = $stageData["description"];
    if (strlen($desc) > 300) {
        $desc = substr($desc, 0, 300) . " ...";
    }

    $datePostee = new DateTime($stageData["date_offre"]);
    $dateElapsed = humanTiming(strtotime($datePostee->format("Y-m-d H:i:s")));

    $tags = array($stageData["promo_concernees"], $stageData["duree"], $stageData["remuneration"] . "€");
    $temp = explode(",", $stageData["competences"]);
    $tags = array_merge($tags, $temp);
    $finalHTML = "";
    foreach ($tags as &$tag) {
        $finalHTML .= '<div class="tag-container">
                        <label class="tag-text">
                            <span>' . $tag . '</span>
                        </label>
                        </div>';
    }

    echo '
    <div class="offre-stage-blog-post-card">
        <div class="offre-stage-container">
            <div class="offre-stage-container1">
                <span class="offre-stage-text">
                    ' . $stageData["nom_entreprise"] . '
                </span>
                <span class="offre-stage-text1">
                    <span>Il y a ' . $dateElapsed . '</span>
                </span>
            </div>
            <h1 class="offre-stage-text2">
                <span>' . $stageData["titre"] . '</span>
            </h1>
            <span class="offre-stage-text3">
                <span>' . $desc . '</span>
            </span>
            <div class="offre-stage-container2">
                ' . $finalHTML . '
            </div>
            <div class="offre-stage-container3">
                <a class="offre-stage-text4" href="affiche&offreID=' . urlencode($stageContainer["id_stage"]) . '">
                    Lire plus -&gt;
                </a>
                <button type="button" class="offre-stage-button button">
                    <img alt="image" src="public/bookmark-svgrepo-com.svg" class="offre-stage-image" />
                </button>
            </div>
        </div>
    </div>
    ';
}
?>
