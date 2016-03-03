<?php

include __DIR__ . '/vendor/autoload.php';
use Pepe\GameOfLife\GameOfLifeFactory;
use Pepe\GameOfLife\GameOfLifeGif;

$gol = new GameOfLifeFactory();
$g = $gol->create($_GET['width'], $_GET['height'], $_POST['xxx']);
$gif = new GameOfLifeGif($g);
$gif->create($_GET['gene']);

