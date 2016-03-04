<?php

namespace Pepe\GameOfLife;

class GameOfLifeFactory
{
    /**
     * @param $width
     * @param $height
     * @param $checked
     * @return GameOfLife
     */
    function create($width, $height, $checked)
    {
        $array = [];
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $array[$x][$y] = isset($checked[$x][$y]) && $checked[$x][$y] ? 1 : 0;
            }
        }
        return new GameOfLife($array);

    }
}