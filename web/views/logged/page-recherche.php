<div>
	<div class="page-recherche-container">
		<div class="page-recherche-container1">
			<div class="page-recherche-container2">
				<form class="page-recherche-form" method="post">
					<select class="page-recherche-select">
						<option value="Option 1" disabled="true" selected="true" class="page-recherche-default"> Date </option>
						<!-- A terme, prendre les options de filtre de la BDD -->
						<option value="Option 2">Dernières 24h</option>
						<option value="Option 3">3 derniers jours</option>
						<option value="Option 4">7 derniers jours</option>
						<option value="Option 5">14 derniers jours</option>
						<option value="Option 6">Ne pas restreindre</option>
					</select>
					<select class="page-recherche-select">
						<option value="Option 1" disabled="true" selected="true" class="page-recherche-default"> Durée </option>
						<option value="Option 2">2 mois</option>
						<option value="Option 3">5-6 mois</option>
						<option value="Option 4">3-4 mois</option>
						<option value="Option 5">6 mois et +</option>
						<option value="Option 6">Ne pas restreindre</option>
					</select>
					<select class="page-recherche-select">
						<option value="Option 1" disabled="true" selected="true" class="page-recherche-default"> Niveau d'études </option>
						<option value="Option 2">Bac+2</option>
						<option value="Option 3">Bac+4</option>
						<option value="Option 4">Bac+3</option>
						<option value="Option 5">Bac+5</option>
						<option value="Option 6">Ne pas restreindre</option>
					</select>
					<select class="page-recherche-select">
						<option value="Option 1" disabled="true" selected="true" class="page-recherche-default"> Secteur d'activité </option>
						<option value="Option 2">Informatique</option>
						<option value="Option 3">BTP</option>
						<option value="Option 3">Ne pas restreindre</option>
					</select>
					<select class="page-recherche-select">
						<option value="Option 1" disabled="true" selected="true" class="page-recherche-default"> Localisation </option>
						<option value="Option 2">Dans un rayon de 25km</option>
						<option value="Option 3">Dans un rayon de 50km</option>
						<option value="Option 3">Ne pas restreindre</option>
					</select>
					<div class="page-recherche-container3">
						<button type="button" class="page-recherche-button button">
							<span>
								<span>FILTRER</span>
								<br />
							</span>
						</button>
					</div>
				</form>
			</div>
			<div class="page-recherche-liste-entreprises">
				<div class="search-bar-container search-bar-root-class-name3">
					<div class="search-bar-container1">
						<img alt="image" src="../public/search-svgrepo-com%20(1).svg" class="search-bar-image" />
						<input type="text" placeholder="Rechercher" class="search-bar-textinput input" />
					</div>
				</div>
				<!-- Spawn one container per thing here -->

				<?php
    				$controller = new MainController();
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

					foreach($datas["stages"] as &$stageContainer){
						$stageData = $controller->mainManager->getStageFromID($stageContainer["id_stage"])[0];
						$desc = $stageData["description"];
						if(strlen($desc) > 300){
							$desc = substr($desc,0,300)." ...";
						}

						$datePostee = new DateTime($stageData["date_offre"]);
						$dateElapsed = humanTiming(strtotime($datePostee->format("Y-m-d H:i:s")));

						$tags = array($stageData["promo_concernees"], $stageData["duree"], $stageData["remuneration"]);
						$temp = explode(",", $stageData["competences"]);
						$tags = array_merge($tags, $temp);
						$finalHTML = "";
						foreach($tags as &$tag){
							$finalHTML .= '<div class="tag-container">
								<label class="tag-text">
									<span>'.$tag.'</span>
								</label>
							</div>';
						}
						
						echo '
						<div class="offre-stage-blog-post-card">
							<div class="offre-stage-container">
								<div class="offre-stage-container1">
									<span class="offre-stage-text">
										'."poop".'
									</span>
									<span class="offre-stage-text1">
										<span>Il y a '.$dateElapsed.'</span>
									</span>
								</div>
								<h1 class="offre-stage-text2">
									<span>'.$stageData["titre"].'</span>
								</h1>
								<span class="offre-stage-text3">
									<span>'.$desc.'</span>
								</span>
								<div class="offre-stage-container2">
									'.$finalHTML.'
								</div>
								<div class="offre-stage-container3">
									<span class="offre-stage-text4">Lire plus -&gt;</span>
									<button type="button" class="offre-stage-button button">
										<img alt="image" src="public/bookmark-svgrepo-com.svg" class="offre-stage-image" />
									</button>
								</div>
							</div>
						</div>
						';
					}
				?>
			</div>
		</div>
	</div>
</div>