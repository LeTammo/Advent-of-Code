<?php

require_once "Misc.php";
require_once './../Misc.php';

$file = readInputFile('input.txt');

$sum = 0;

while ($line = fgets($file)) {
    $sameItems = array_intersect(
        str_split(substr($line, 0, strlen($line) / 2)),
        str_split(substr($line, strlen($line) / 2))
    );
    foreach (array_unique($sameItems) as $item) {
        $sum += getLetterToInt($item);
    }
}

fclose($file);

echo PHP_EOL . $sum . PHP_EOL . PHP_EOL;

