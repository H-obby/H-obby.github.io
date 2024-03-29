<form class="search-bar-form" action="search" method="post">
  <button type="submit" class="search-bar-button button">
    <img alt="image" src="public/search-svgrepo-com%20(1).svg" class="search-bar-image" />
  </button>
  <input name="searchValue" type="text" placeholder="Rechercher" class="search-bar-textinput input" />
  <select name="searchType" class="search-bar-select">
    <option value="stage">Stage</option>
    <option value="entreprise">Entreprise</option>
    <?php if ($_SESSION["permissionLevel"] > 1): ?>
      <option value="utilisateur">Utilisateur</option>
      <option value="tuteur">Tuteur</option>
    <?php endif; ?>
  </select>
</form>
