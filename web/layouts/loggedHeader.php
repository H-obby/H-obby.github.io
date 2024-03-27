<div>
	<link href="../components/logged-in-header.css" rel="stylesheet" />
	<link href="../components/search-bar.css" rel="stylesheet" />

    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet"
    />

	<header data-role="Header" class="logged-in-header-header">
		<a href="index" class="logged-in-header-logo-name">
			<img alt="Logo Practicum" src="../public/practicum2.svg" class="logged-in-header-image" />
		</a>
		<div class="search-bar-container search-bar-root-class-name2">
			<?php require_once("layouts/search-bar.php")?>
		</div>
		<div class="logged-in-header-container">
			<div class="logged-in-header-btn-group">
				<button type="button" class="logged-in-header-button button">
					<img alt="image" src="../public/notification-12-svgrepo-com.svg" class="logged-in-header-image1" />
				</button>

				<!-- Dropdown -->
				<div class="dropdown_li">
					<img src="../public/leetram-200h.png" class="profile" />
					<ul class="dropdown_ul">
					  <li class="sub-item">
						<span class="material-icons-outlined"> manage_accounts </span>
						<p>Profile</p>
					  </li>
					  <li class="sub-item">
						<span class="material-icons-outlined">
						  format_list_bulleted
						</span>
						<p>Paramètres</p>
					  </li>
					  <li class="sub-item">
						<span class="material-icons-outlined"> logout </span>
						<p>Déconnection</p>
					  </li>
					</ul>
				</div>
			</div>
		</div>
	</header>
</div>