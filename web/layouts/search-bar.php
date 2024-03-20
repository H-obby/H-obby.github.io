<div class="search-bar-container search-bar-root-class-name2">
  <form class="search-bar-container1" method="post">
    <img alt="image" src="../public/search-svgrepo-com%20(1).svg" class="search-bar-image" />
    <input name="search" type="text" placeholder="Rechercher" class="search-bar-textinput input" />
  </form>
</div>

<?php
  //search
  if(isset($_POST["search"]) && $_POST["search"] != "null"){
    header("Location: search");
  }
?>