<?php
define('__ROOT__', dirname(dirname(__FILE__)).'/..'); 
require_once(__ROOT__.'/config/parameters.php');
require_once(__ROOT__.'/src/library/DB.php');
require_once(__ROOT__.'/src/controllers/waterlevelController.php');

$waterlevel = new waterlevel();
$id = $waterlevel->getRequestId();
if ($id!==null && isset($_GET['level'])) {
	$waterlevel->setWaterlevel($id,$_GET['level'],date("Y-m-d H:i:s"));
}

$currenLevel = $waterlevel->getLastLevel();
echo json_encode($currenLevel);
