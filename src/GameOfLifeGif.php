<?php

namespace Pepe\GameOfLife;

class GameOfLifeGif
{
    /**
     *
     *
     * @var GameOfLife
     */
    private $gol;

    /**
     * GameOfLifeGif constructor.
     *
     * @param GameOfLife $gol
     */
    public function __construct(GameOfLife $gol)
    {
        $this->gol = $gol;
    }

    /**
     *
     *
     * @param int $gene
     * return void
     */
    public function create($gene)
    {
        $frames = [];
        $framed = [];
        $gol = $this->gol;
        for ($i = 0; $i < $gene; $i++) {
            $data = $gol->getData();
            ob_start();
            $snap = $this->createSnap($data);
            imagegif($snap);
            $frames[]=ob_get_contents();
            $framed[]=40;
            ob_end_clean();
            $gol = $gol->nextGen($data);
        }
        $gif = new GIFEncoder($frames, $framed, 0, 2, 0, 0, 0, 'bin');
        $name = 'g' . time() . '.gif';
        $fp = fopen($name, 'wb');
        fwrite($fp, $gif->GetAnimation());
        fclose($fp);
    }

    private function createSnap($array)
    {
        $height = count($array);
        $width = max(array_map('count', $array));
        $image = imagecreatetruecolor($width * 5, $height * 5);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {

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

}