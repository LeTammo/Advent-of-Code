<?php

require_once "Misc.php";

$filename = 'input.txt';
if (!file_exists($filename)) {
    echo "Input file not found!" . PHP_EOL;
    exit;
}
$file = fopen($filename, 'r');

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

