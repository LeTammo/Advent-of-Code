<?php

$trees = file('input.txt', FILE_IGNORE_NEW_LINES);


$height = count($trees);
$width = strlen($trees[0]);
$visible = array_fill(0, $height, array_fill(0, $width, 0));

for ($i = 0; $i < $height; $i++) {
    $maxNorth = -1;
    $maxEast = -1;
    $maxSouth = -1;
    $maxWest = -1;

    for ($j = 0; $j < $width; $j++) {
        if ($trees[$i][$j] > $maxWest) {
            $maxWest = $trees[$i][$j];
            $visible[$i][$j] = 1;
        }

        if ($trees[$i][$width-1-$j] > $maxEast) {
            $maxEast = $trees[$i][$width-1-$j];
            $visible[$i][$width-1-$j] = 1;
        }

        if ($trees[$j][$i] > $maxNorth) {
            $maxNorth = $trees[$j][$i];
            $visible[$j][$i] = 1;
        }

        if ($trees[$height-1-$j][$i] > $maxSouth) {
            $maxSouth = $trees[$height-1-$j][$i];
            $visible[$height-1-$j][$i] = 1;
        }
    }
}

$x = 0;
$y = 0;
$max = 0;
for ($i = 0; $i < $height; $i++) {
    for ($j = 0; $j < $width; $j++) {
        $maxNorth = 0;
        $maxEast = 0;
        $maxSouth = 0;
        $maxWest = 0;

        $l = $j;
        do {
            $l--;
            $maxWest++;
        } while ($l-1 >= 0 && $trees[$i][$j] > $trees[$i][$l]);

        $l = $j;
        do {
            $l++;
            $maxEast++;
        } while ($l+1 < $height && $trees[$i][$j] > $trees[$i][$l]);

        $k = $i;
        do {
            $k--;
            $maxNorth++;
        } while ($k-1 >= 0 && $trees[$i][$j] > $trees[$k][$j]);

        $k = $i;
        do {
            $k++;
            $maxSouth++;
        } while ($k+1 < $width && $trees[$i][$j] > $trees[$k][$j]);

        $score = $maxNorth * $maxEast * $maxSouth * $maxWest;
        if ($score > $max) {
            $x = $j;
            $y = $i;
            $max = $score;
        }
    }
}

echo 'Visible Trees: ' . array_sum(array_map('array_sum', $visible)) . PHP_EOL;
echo 'Best treehouse score: ' . $max . PHP_EOL;
echo 'Treehouse position: ' . $x . ' ' . $y . PHP_EOL;