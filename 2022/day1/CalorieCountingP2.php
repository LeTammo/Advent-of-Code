<?php

require_once './../Misc.php';

$file = readInputFile('input.txt');

$biggestSums = [0, 0, 0];
$currentSum = 0;

while ($line = fgets($file)) {
    if (strlen($line) !== 1) {
        $currentSum += (int)$line;
        continue;
    }
    if ($currentSum > $biggestSums[0]) {
        echo "current sum = " . $currentSum . " is higher\n";
        $biggestSums[0] = $currentSum;
        sort($biggestSums);
    }
    $currentSum = 0;
}

fclose($file);

echo "sum of biggest sum = " . array_sum($biggestSums) . PHP_EOL;