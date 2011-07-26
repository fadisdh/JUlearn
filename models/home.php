<?php

global $registry;
define('URL', realpath(dirname(__FILE__)));

include 'includes/load.php';

$registry = new Registry();
$router = new Router($_GET['rt'], $registry);

$registry -> router = $router;
$router -> getPage();