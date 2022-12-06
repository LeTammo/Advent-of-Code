<?php

$file = fopen('input.txt', 'rb');
if ($file) {
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
}

function getLetterToInt(string $letter): int
{
    if (ord($letter) > 90) {
        return ord($letter) - 96;
    }
    return ord($letter) - 38;
}