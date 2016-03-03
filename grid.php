<?php


if (isset($_POST['width']) && isset($_POST['height']) && isset($_POST['generations'])) {

    echo "<form action=\"gif.php?width=" . $_POST['width'] .
        "&height=" . $_POST['height'] .
        "&gene=" . $_POST['generations'] . "\" method = \"post\">";
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

} else {
    echo "Nejsou zadany hodnoty";
}

