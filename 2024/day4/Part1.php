<?php

require_once './../../Misc.php';


const WORD = "XMAS";
define("WORD_ARRAY", str_split(WORD));
define("WORD_LENGTH", strlen(WORD));
const DIRECTIONS = [
    [-1, -1], [-1, 0], [-1, 1],
    [ 0, -1],          [ 0, 1],
    [ 1, -1], [ 1, 0], [ 1, 1],
];

runOnInputFile(static function ($file): void
{
    $wordGrid = [];
    while ($line = fgets($file)) {
        $wordGrid[] = str_split(trim($line));
    }

    $xmasAppearances = 0;

    foreach ($wordGrid as $i => $iValue) {
        foreach ($iValue as $j => $jValue) {
            search($wordGrid, $i, $j, $xmasAppearances);
        }
    }


    echo "Solution for Part 1: $xmasAppearances\n";
}, "input.txt");

function search(array $wordGrid, int $i, int $j, int &$xmasAppearances): void
{
    foreach (DIRECTIONS as $direction) {
        for ($k = 0; $k < WORD_LENGTH; $k++) {
            $currentChar = $wordGrid[$i + $direction[0] * $k][$j + $direction[1] * $k] ?? null;
            if (WORD_ARRAY[$k] !== $currentChar) {
                continue 2;
            }
        }

        $xmasAppearances++;
    }
}