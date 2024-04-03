<?php
echo '
<header class="header-header">
	<a href="index&t='.time().'" class="header-logo-name">
		<img class="header-image" alt="Logo Practicum" id="logo"/>
	</a>
	<div class="header-btn-group">
		<a href="login" class="header-auth button">
			<span href="index">Authentification</span>
		</a>
	</div>
</header>
<script>
	if(screen.width < 767){
		document.getElementById("logo").src = "../public/practicum.svg";
	} else {
		document.getElementById("logo").src = "../public/practicum2.svg";
	}
	addEventListener("resize", function(){
		if(screen.width < 767){
			document.getElementById("logo").src = "../public/practicum.svg";
		} else {
			document.getElementById("logo").src = "../public/practicum2.svg";
		}
	});
</script>
';