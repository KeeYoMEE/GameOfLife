<?php
    include __DIR__ . '/vendor/autoload.php';

    use Pepe\GameOfLife\GameOfLife;
    echo "<form method = \"post\">";
    echo "<table>";
    for ($y = 0; $y <= $_POST['height']; $y++) {
        echo "<tr>";
        for ($x = 0; $x <= $_POST['width']; $x++) {
            echo "<td><input type=\"checkbox\" name=\"A$y.$x\"></td>";
        }
        echo "</tr>";
    }
    echo "<input type=\"submit\" name = \"submit\">";
    echo "</form>";

    if(isset($_POST['submit'])) {
        $gol = new GameOfLife();
        $array = $gol -> createArray($_POST['width'], $_POST['height']);
        $snap = $gol -> createSnap($array, $_POST['width'], $_POST['height']);

    }
