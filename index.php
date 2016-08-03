<?php
require_once('lib' . DIRECTORY_SEPARATOR . 'php-rest' . DIRECTORY_SEPARATOR . 'rest' . DIRECTORY_SEPARATOR . 'Server.php');

$server = new Server("Game Frame Web Services");

require_once('services' . DIRECTORY_SEPARATOR . 'games.php');
require_once('services' . DIRECTORY_SEPARATOR . 'highscore.php');

$server->addService(new GamesService());
$server->addService(new HighscoreService());

$server->handleRequest();
