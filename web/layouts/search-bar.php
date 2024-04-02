<form class="search-bar-form" action="" method="" onsubmit="return searchBar()">
  <button type="submit" class="search-bar-button button">
    <img alt="image" src="public/search-svgrepo-com%20(1).svg" class="search-bar-image" />
  </button>
  <input id="search" name="searchValue" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : "" ?>" type="text" placeholder="Rechercher" class="search-bar-textinput input" />
  <select id="type" name="searchType" class="search-bar-select">
    <option value="stage" <?php echo isset($_GET["type"]) && $_GET["type"] == "stage" ? "selected" : "" ?> >Stage</option>
    <option value="entreprise" <?php echo isset($_GET["type"]) && $_GET["type"] == "entreprise" ? "selected" : "" ?> >Entreprise</option>
    <?php if ($_SESSION["permissionLevel"] > 1): ?>
      <option value="utilisateur" <?php echo isset($_GET["type"]) && $_GET["type"] == "utilisateur" ? "selected" : "" ?> >Utilisateur</option>
      <?php if ($_SESSION["permissionLevel"] > 2): ?>
        <option value="tuteur" <?php echo isset($_GET["type"]) && $_GET["type"] == "tuteur" ? "selected" : "" ?> >Tuteur</option>
      <?php endif; ?>
    <?php endif; ?>
  </select>
</form>

<script>
  function searchBar(){
    window.location.replace(`search&search=${$("#search").val()}&type=${$("#type").val()}`);
    return false;
  }
</script>