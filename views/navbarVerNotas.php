<?php

require_once(__DIR__."/../core/ViewManager.php");

?>

<header id="main-header">
  <id="logoCabecera"><img class="logo" src = "../img/icono.png"/>

  <a href="../controller/defaultController.php?controlador=language&accion=change&lang=es" id = "salir"><?= i18n("Español") ?></a>
  <a href="../controller/defaultController.php?controlador=language&accion=change&lang=en" id = "salir"><?= i18n("Inglés") ?></a>

</div>
  <div class = "bloque">
    <br><br><br>
    <a id = "salir" href="misNotasCompartidas.php"><?= i18n("Notas compartidas")?></a>
    <a id = "salir" href="../controller/defaultController.php?controlador=usuario&accion=logout"><?= i18n("Salir")?></a>
  </div>
</header>
