<?php
    include('./src/GIFEncoder.class.php');
    include __DIR__ . '/vendor/autoload.php';

    use Pepe\GameOfLife\GameOfLife;
    echo "<form method = \"post\">";
    echo "<table>";
    for ($y = 0; $y <= $_POST['height']; $y++) {
        echo "<tr>";
        for ($x = 0; $x <= $_POST['width']; $x++) {
            echo "<td><input type=\"checkbox\" name=\"xxx[$x][$y]\"></td>";
        }
        echo "</tr>";
    }
    echo "<input type=\"submit\" name = \"submit\">";
    echo "</form>";

    if(isset($_POST['submit'])) {
        $gol = new GameOfLife();
        $array = $gol -> createArray($_POST['width'], $_POST['height'], $_POST['xxx']);
        $snap = $gol -> createSnap($array, $_POST['width'], $_POST['height']);
        ob_start();
        imagegif($snap);
        $frames[]=ob_get_contents();
        $framed[]=40;
        ob_end_clean();
        for ($i = 2; $i <= $_POST['generations']; $i++) {
            $ngene = $gol -> nextGene($array);
            $snap = $gol -> createSnap($array, $_POST['width'], $_POST['height']);
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


    }
