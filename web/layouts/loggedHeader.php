<?php
if($_SESSION["permissionLevel"] < 3){
	$pfp = $controller->mainManager->getUserFromID($controller->mainManager->getUserIDFromLogin()[0]["id_utilisateur"])[0]["pfp"];
} else {
	$pfp = "car.jpg";
}
?>

<div>
	<header data-role="Header" class="logged-in-header-header">
		<a href="index" class="logged-in-header-logo-name">
			<img alt="Logo Practicum" src="../public/practicum2.svg" class="logged-in-header-image" />
		</a>
		<div class="search-bar-container search-bar-root-class-name2">
			<?php require("layouts/search-bar.php")?>
		</div>
		<div class="logged-in-header-container">
			<div class="logged-in-header-btn-group">
				<button type="button" class="logged-in-header-button button">
					<img alt="image" src="../public/notification-12-svgrepo-com.svg" class="logged-in-header-image1" />
				</button>

				<!-- Dropdown -->
				<div class="dropdown_li">
					<img src="<?= URL.'public/pfp/'.$pfp?>" class="profile" alt="profile picture"/>
					<ul class="dropdown_ul">
					  <li class="sub-item">
						<span class="material-symbols-outlined"> manage_accounts </span>
						<p>Profile</p>
					  </li>
					  <li class="sub-item">
						<span class="material-symbols-outlined">
							format_list_bulleted
						</span>
						<p>Paramètres</p>
					  </li>
					  <li class="sub-item" onclick="location.href='wishlist&t=<?=time()?>'">
						<a class="material-symbols-outlined" href="wishlist&t=<?=time()?>">
							bookmark
						</a>
						<p>Wishlist</p>
					  </li>
					  <li class="sub-item" onclick="location.href='phpScripts/disconnect.php'">
						<span class="material-symbols-outlined"> logout </span>
						<p>Déconnection</p>
					  </li>
					</ul>
				</div>
			</div>
		</div>
	</header>
</div>