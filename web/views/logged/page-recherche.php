<div>
	<div class="page-recherche-container">
		<div class="page-recherche-container1">
			<div class="page-recherche-container2">
				<form class="page-recherche-form" action="" method="post">
					<select name="date" class="page-recherche-select">
						<option value="null" <?php echo !isset($_POST["date"]) || $_POST["date"] == "null" ? "selected" : "" ?> disabled class="page-recherche-default"> Dates </option>
						<option value="24h" <?php echo isset($_POST["date"]) && $_POST["date"] == "24h" ? "selected" : "" ?> >Dernières 24h</option>
						<option value="3dj" <?php echo isset($_POST["date"]) && $_POST["date"] == "3dj" ? "selected" : "" ?> >3 derniers jours</option>
						<option value="7dj" <?php echo isset($_POST["date"]) && $_POST["date"] == "7dj" ? "selected" : "" ?> >7 derniers jours</option>
						<option value="14dj" <?php echo isset($_POST["date"]) && $_POST["date"] == "14dj" ? "selected" : "" ?> >14 derniers jours</option>
						<option value="null">Ne pas restreindre</option>
					</select>
					<select name="duree" class="page-recherche-select">
						<option value="null" <?php echo !isset($_POST["duree"]) || $_POST["duree"] == "null" ? "selected" : "" ?> disabled class="page-recherche-default"> Durée </option>
						<option value="2m" <?php echo isset($_POST["duree"]) && $_POST["duree"] == "2m" ? "selected" : "" ?> >2 mois</option>
						<option value="34m" <?php echo isset($_POST["duree"]) && $_POST["duree"] == "34m" ? "selected" : "" ?> >3-4 mois</option>
						<option value="56m" <?php echo isset($_POST["duree"]) && $_POST["duree"] == "56m" ? "selected" : "" ?> >5-6 mois</option>
						<option value="6+m" <?php echo isset($_POST["duree"]) && $_POST["duree"] == "6+m" ? "selected" : "" ?> >6 mois et +</option>
						<option value="null">Ne pas restreindre</option>
					</select>
					<select name="niv" class="page-recherche-select">
						<option value="null" <?php echo !isset($_POST["niv"]) || $_POST["niv"] == "null" ? "selected" : "" ?>  disabled class="page-recherche-default"> Niveau d'études </option>
						<option value="b+2" <?php echo isset($_POST["niv"]) && $_POST["niv"] == "b+2" ? "selected" : "" ?> >Bac+2</option>
						<option value="b+3" <?php echo isset($_POST["niv"]) && $_POST["niv"] == "b+3" ? "selected" : "" ?> >Bac+3</option>
						<option value="b+4" <?php echo isset($_POST["niv"]) && $_POST["niv"] == "b+4" ? "selected" : "" ?> >Bac+4</option>
						<option value="b+5" <?php echo isset($_POST["niv"]) && $_POST["niv"] == "b+5" ? "selected" : "" ?> >Bac+5</option>
						<option value="null">Ne pas restreindre</option>
					</select>
					<select name="sec" class="page-recherche-select">
						<option value="null" <?php echo !isset($_POST["sec"]) || $_POST["sec"] == "null" ? "selected" : "" ?>  disabled class="page-recherche-default"> Secteur d'activité </option>
						<option value="info" <?php echo isset($_POST["sec"]) && $_POST["sec"] == "info" ? "selected" : "" ?> >Informatique</option>
						<option value="btp" <?php echo isset($_POST["sec"]) && $_POST["sec"] == "btp" ? "selected" : "" ?> >BTP</option>
						<option value="null">Ne pas restreindre</option>
					</select>
					<input type="hidden" value="<?=htmlentities($datas["searchType"])?>" name="searchType" />
					<input type="hidden" value="<?=htmlentities($datas["searchValue"])?>" name="searchValue" />
					<div class="page-recherche-container3">
						<button type="submit" name="filter" class="page-recherche-button button">
							FILTRER
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

					$allStageIDs = [];
					$glIndex = 0;

					foreach($datas["stages"] as &$stageContainer){
						$stageData = $controller->mainManager->getStageFromID($stageContainer["id_stage"])[0];
						$desc = $stageData["description"];
						$allStageIDs[$glIndex] = $stageContainer["id_stage"];
						if(strlen($desc) > 300){
							$desc = substr($desc,0,300)." ...";
						}

						$datePostee = new DateTime($stageData["date_offre"]);
						$dateElapsed = humanTiming(strtotime($datePostee->format("Y-m-d H:i:s")));

						$tags = array(ucfirst($stageData["promo_concernees"]), $stageData["domaine"], $stageData["duree"], $stageData["remuneration"]."€");
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
						<div class="offre-stage-blog-post-card" action="" method="post">
							<div class="offre-stage-container" id="stageCard'.$stageContainer["id_stage"].'">
								<div class="offre-stage-container1">
									<span class="offre-stage-text">
										'.$stageData["nom_entreprise"].'
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
									<a class="offre-stage-text4">
										Lire plus -&gt;
									</a>
									<button type="button" id="fav'.$stageContainer["id_stage"].'" class="offre-stage-button button">
										<img alt="image" src="public/bookmark-svgrepo-com.svg" class="offre-stage-image" />
									</button>
								</div>
							</div>
						</div>
						';
						$glIndex++;
					}

					$allStageCardIDs = $allStageIDs;
					$allStageFavIDs = $allStageIDs;
					foreach($allStageIDs as $key=>$id){
						$allStageCardIDs[$key] = "stageCard".$id;
						$allStageFavIDs[$key] = "fav".$id;
					}
					$allStageIDsStr = "['".implode("', '", $allStageIDs)."']";

					$perms = $_SESSION["permissionLevel"];

					echo '
					<script>
						let cards = [];
						let favs = [];
						let whichHovering = -1;
						let isHoveringFavorite = false;

						for(let x in '.$allStageIDsStr.') {
							cards.push(document.getElementById("stageCard"+'.$allStageIDsStr.'[x]));
							favs.push(document.getElementById("fav"+'.$allStageIDsStr.'[x]));

							favs.forEach(function(element){
								element.onmouseover = function(){
									isHoveringFavorite = true;
									//console.log(isHoveringFavorite);
								}
								element.onmouseout = function(){
									isHoveringFavorite = false;
									//console.log(isHoveringFavorite);
								}
							});

							cards.forEach(function(element){
								element.onmouseover = function(){
									whichHovering = Number(element.id.substr(element.id.length - 1));
									//console.log(whichHovering);
								}
								element.onmouseout = function(){
									whichHovering = Number(-1);
									//console.log(whichHovering);
								}
								element.onclick = function(){
									if (isHoveringFavorite && whichHovering == Number(element.id.substr(element.id.length - 1))){
										if('.$perms.' == 1 || '.$perms.' == 2){
											let formData = new FormData();
											formData.append("id", element.id.substr(element.id.length - 1));
											fetch("function--addWishlist", {method: "POST", body: formData})
											.then(res => res.text())
											.then(txt => console.log(txt))
											.catch(err => console.error(err));
										}
										return false;
									} else {
										window.location.href = "affiche&offreID="+element.id.substr(element.id.length - 1);
									}
								}
							});
						}
					</script>';
				?>
			</div>
		</div>
	</div>
</div>