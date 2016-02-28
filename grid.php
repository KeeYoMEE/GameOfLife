<?php
    session_start();

    $_SESSION['width'] = $_POST['width'];
    $_SESSION['height'] = $_POST['height'];
    $_SESSION['gene'] = $_POST['generations'];

    echo "<form action=\"gif.php\" method = \"post\">";
    echo "<table>";
    for ($y = 0; $y < $_POST['height']; $y++) {
        echo "<tr>";
        for ($x = 0; $x < $_POST['width']; $x++) {
            echo "<td><input type=\"checkbox\" name=\"xxx[$x][$y]\"></td>";
        }
        echo "</tr>";
    }
    echo "<input type=\"submit\" name = \"submit\">";
    echo "</form>";

