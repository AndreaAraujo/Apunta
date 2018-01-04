<?php
//file: view/posts/index.php

require_once(__DIR__."/../core/ViewManager.php");
$view = ViewManager::getInstance();

$notas = $view->getVariable("nota");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("nombre", "Nota");

?><h1><?=i18n("notaaas")?></h1>

<table border="1">
	<tr>
		<th><?= i18n("Title")?></th><th><?= i18n("Author")?></th><th><?= i18n("Actions")?></th>
	</tr>

	<?php foreach ($notas as $nota): ?>
		<tr>
			<td>
				<a href="index.php?controller=nota&amp;action=view&amp;id=<?= $nota->getIdNota() ?>"><?= htmlentities($nota->getNombre()) ?></a>
			</td>
			<td>
				<?= $nota->getUsuario_idUsuario() ?>
			</td>

</tr>
<?php endforeach; ?>

</table>
