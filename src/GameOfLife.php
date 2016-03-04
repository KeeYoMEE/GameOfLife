<?php

namespace Pepe\GameOfLife;

class GameOfLife
{
    private $array;

    /**
     * GameOfLife constructor.
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->array;
    }

    /**
     * @param $array
     * @param $x
     * @param $y
     * @return int
     */
    private function checkNeighbours($array, $x, $y)
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

    /**
     * @param $array
     * @param $x
     * @param $y
     * @return bool
     */
    private function checkAlive($array, $x, $y)
    {
        $n = $this->checkNeighbours($array, $x, $y);
        if ($array[$x][$y] == 1) {
            return 3 === $n || 2 === $n;
        } else {
            return 3 === $n;
        }
    }

    /**
     * @param $array
     * @return static
     */
    public function nextGen($array)
    {
        $narray = [];

        foreach ($array as $y => $row) {
            foreach ($row as $x => $cell) {
                $this->checkAlive($array, $x, $y) ? $narray[$x][$y] = 1 : $narray[$x][$y] = 0;
            }
        }
        return new static($narray);
    }
}