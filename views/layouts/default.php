<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/index.css" type="text/css">
	<!-- enable ji18n() javascript function to translate inside your scripts -->
	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>
	<!-- header -->
	<header  id="main-header">
		<?php if (isset($currentuser)): ?>
			<id="logoCabecera"><img class="logo" src = "../../img/icono.png"/>

		  <a href="index.php?controller=language&action=change&lang=es" id = "salir"><?= i18n("Español") ?></a>
		  <a href="index.php?controller=language&action=change&lang=en" id = "salir"><?= i18n("Inglés") ?></a>

		</div>
		  <div class = "bloque">
		    <br><br><br>
		   <!-- <a id = "salir" href="misNotasCompartidas.php"><?= i18n("Notas compartidas")?></a>-->
		    <a id = "salir" href="index.php?controller=usuario&action=logout"><?= i18n("Salir")?></a>
		  </div>

		<?php endif ?>

	</header>

	<main>
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

	<footer>
		<?php
		include(__DIR__."/language_select_element.php");
		?>
	</footer>

</body>
</html>
