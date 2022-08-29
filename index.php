<?php
define ('INDEX', 'controllerFile.php');
require_once 'controllerFile.php';
require_once 'pageGen.php';

session_start();

$controller = new Controller();
$controller->handleRequest();

?>