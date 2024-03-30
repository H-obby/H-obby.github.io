<form class="search-bar-form" action="search" method="post">
  <button type="submit" class="search-bar-button button">
    <img alt="image" src="public/search-svgrepo-com%20(1).svg" class="search-bar-image" />
  </button>
  <input name="searchValue" value="<?php echo isset($_POST["searchValue"]) ? $_POST["searchValue"] : "" ?>" type="text" placeholder="Rechercher" class="search-bar-textinput input" />
  <select name="searchType" class="search-bar-select">
    <option value="stage" <?php echo isset($_POST["searchType"]) && $_POST["searchType"] == "stage" ? "selected" : "" ?> >Stage</option>
    <option value="entreprise" <?php echo isset($_POST["searchType"]) && $_POST["searchType"] == "entreprise" ? "selected" : "" ?> >Entreprise</option>
    <?php if ($_SESSION["permissionLevel"] > 1): ?>
      <option value="utilisateur" <?php echo isset($_POST["searchType"]) && $_POST["searchType"] == "utilisateur" ? "selected" : "" ?> >Utilisateur</option>
      <option value="tuteur" <?php echo isset($_POST["searchType"]) && $_POST["searchType"] == "tuteur" ? "selected" : "" ?> >Tuteur</option>
    <?php endif; ?>
  </select>
</form>
