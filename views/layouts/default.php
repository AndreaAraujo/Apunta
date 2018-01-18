<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $view->getVariable("title", "Apunta") ?></title>


	<link rel="stylesheet" href="css/compartirNota.css" type="text/css">
	<link rel="stylesheet" href="css/index.css" type="text/css">
	<link rel="stylesheet" href="css/crearNota.css" type="text/css">
	<link rel="stylesheet" href="css/editarNota.css" type="text/css">
	<link rel="stylesheet" href="css/footer.css" type="text/css">
	<link rel="stylesheet" href="css/misNotasCompartidas.css" type="text/css">
	<link rel="stylesheet" href="css/registro.css" type="text/css">
	<link rel="stylesheet" href="css/verNotas.css" type="text/css">

	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel ="stylesheet" href="css/bootstrap.min.css">
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>



	<!-- enable ji18n() javascript function to translate inside your scripts -->
	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>

<!-- header -->
<?php if (isset($currentuser)): ?>
<header  id="main-header">

		<id="logoCabecera"><img class="logo" src = "img/icono.png"/>

		<a href="index.php?controller=language&action=change&lang=es" id = "salir"><?= i18n("Español") ?></a>
		<a href="index.php?controller=language&action=change&lang=en" id = "salir"><?= i18n("Inglés") ?></a>

	</div>
		<div class = "bloque">
			<br><br><br>
			<a id = "salir" href="index.php?controller=nota&action=index"><?= i18n("Mis Notas")?></a>
			<a id = "salir" href="index.php?controller=NotaCompartida&action=verMisNotasCompartidas"><?= i18n("Notas compartidas")?></a>
			<a id = "salir" href="index.php?controller=usuario&action=logout"><?= i18n("Salir")?></a>
		</div>



</header>
<?php endif ?>

<body style="overflow-y:scroll">


	<div id="main-content" >
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</div>

	<footer id="main-footer">
		<?php
		include(__DIR__."/language_select_element.php");
		?>
	</footer>

</body>
</html>
