<?php

require_once "Misc.php";
require_once './../Misc.php';

$file = readInputFile('input.txt');

$sum = 0;

while (($line = fgets($file)) && ($line2 = fgets($file)) && ($line3 = fgets($file))) {
    $sameItems = array_intersect(
        str_split(trim($line)),
        str_split(trim($line2)),
        str_split(trim($line3)),
    );
    foreach (array_unique($sameItems) as $item) {
        $sum += getLetterToInt($item);
    }
}

fclose($file);

echo PHP_EOL . $sum . PHP_EOL . PHP_EOL;

