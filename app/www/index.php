<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/config/parameters.php');
require_once(__ROOT__.'/config/config.php');
require_once(__ROOT__.'/src/library/DB.php');
require_once(__ROOT__.'/src/controllers/waterlevelController.php');

$waterlevel = new waterlevel();
if ($waterlevel->getRequestId() === null && isset($_GET['request'])){
	$waterlevel->setRequest();
}

$levels = $waterlevel->getLastLevels();

require_once(__ROOT__.'/src/templates/header.html');
require_once(__ROOT__.'/src/templates/index.html');
require_once(__ROOT__.'/src/templates/footer.html');