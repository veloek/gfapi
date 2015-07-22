<?php
require_once('lib' . DIRECTORY_SEPARATOR . 'php-rest' . DIRECTORY_SEPARATOR . 'Server.php');

$server = new Server("Game Frame Web Services");

require_once('services' . DIRECTORY_SEPARATOR . 'games.php');

$server->addService(new GamesService());

$server->handleRequest();
