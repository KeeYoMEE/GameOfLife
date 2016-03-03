<?php

namespace Pepe\GameOfLife;

class GameOfLifeFactory
{
    function create($width, $height, $checked)
    {
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                if (isset($checked[$x][$y])) {
                    $array[$x][$y] = 1;
                } else {
                    $array[$x][$y] = 0;
                }
            }
        }
        return new GameOfLife($array);

    }
}