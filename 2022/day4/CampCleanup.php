<?php

require_once './../Misc.php';
$file = readInputFile('input.txt');

$count = 0;

while ($line = fgets($file)) {
    $parts = explode(',', trim($line));
    $parts[0] = explode('-', $parts[0]);
    $parts[1] = explode('-', $parts[1]);

    if (($parts[0][0] <= $parts[1][0] && $parts[0][1] >= $parts[1][1])
        || ($parts[0][0] >= $parts[1][0] && $parts[0][1] <= $parts[1][1])) {
        $count++;
    }
}

fclose($file);

echo PHP_EOL . $count . PHP_EOL . PHP_EOL;
