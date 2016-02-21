<?php

namespace Pepe\GameOfLife;

class GameOfLife
{
    public function createArray($width, $height)
    {
        for ($x = 0; $x <= $height; $x++) {
            for ($y = 0; $y <= $width; $y++) {
                if ($_POST["A$x.$y"]) {
                    $array[$x][$y] = 1;
                } else {
                    $array[$x][$y] = 0;
                }
            }
        }
        return $array;
    }

    public function createSnap($array, $width, $height)
    {
        $image = imagecreatetruecolor($width * 5, $height * 5);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        for ($x = 0; $x <= $height; $x++) {
            for ($y = 0; $y <= $width; $y++) {

                $v = $x * 5;
                $s = $y * 5;

                if ($array[$x][$y] == 1) {
                    for ($i = 0; $i <= 4; $i++) {
                        for ($ii = 0; $ii <= 4; $ii++) {
                            imagesetpixel($image, $v + $i, $s + $ii, $black);
                        }
                    }
                } else {
                    for ($i = 0; $i <= 4; $i++) {
                        for ($ii = 0; $ii <= 4; $ii++) {
                            imagesetpixel($image, $v + $i, $s + $ii, $white);
                        }
                    }
                }
            }
        }
        return $image;
    }

    public function checkNeighbours($array, $x, $y)
    {
        $n = 0;
        for ($i = $x - 1; $i <= $x + 1; $i++) {
            for ($ii = $y - 1; $ii <= $y + 1; $ii++) {
                if (isset($array[$i][$ii]) && [$x, $y] !== [$i, $ii]) {
                    if ($array[$i][$ii] == 1) {
                        $n++;
                    }
                }
            }
        }
        return $n;
    }

    public function checkAlive($array, $x, $y)
    {
        $n = $this -> checkNeighbours($array, $x, $y);
        if ($array[$x][$y] == 1) {
            if ($n == 3 || $n == 2) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($n == 3) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function nextGene($array)
    {
        $narray = [];

        foreach ($array as $y => $row) {
            foreach ($row as $x => $cell) {
                $c = $this -> checkAlive($array, $x, $y);
                if ($c == true) {
                    $narray[$x][$y] = 1;
                } else {
                    $narray[$x][$y] = 0;
                }
            }
        }
        return $narray;
    }

}