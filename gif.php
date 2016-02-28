<?php
session_start();
include('./src/GIFEncoder.class.php');
include __DIR__ . '/vendor/autoload.php';
use Pepe\GameOfLife\GameOfLife;

$gol = new GameOfLife();
$array = $gol -> createArray($_SESSION['width'], $_SESSION['height'], $_POST['xxx']);
$snap = $gol -> createSnap($array, $_SESSION['width'], $_SESSION['height']);
ob_start();
imagegif($snap);
$frames[]=ob_get_contents();
$framed[]=40;
ob_end_clean();
for ($i = 2; $i <= $_POST['generations']; $i++) {
    $ngene = $gol -> nextGene($array);
    $snap = $gol -> createSnap($array, $_SESSION['width'], $_SESSION['height']);
    ob_start();
    imagegif($snap);
    $frames[]=ob_get_contents();
    $framed[]=40;
    ob_end_clean();
}
$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
$name = './gif/' . time() . '.gif';
$fp = fopen($name, 'w');
fwrite($fp, $gif->GetAnimation());
fclose($fp);