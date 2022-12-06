<?php

$file = fopen("input.txt", "r");
if ($file) {

    $biggestSum = 0;
    $currentSum = 0;

    while ($line = fgets($file)) {
        if (strlen($line) !== 1) {
            $currentSum += (int) $line;
            continue;
        }
        if ($currentSum > $biggestSum) {
            echo "current sum = " . $currentSum . " is higher\n";
            $biggestSum = $currentSum;
        }
        $currentSum = 0;
    }

    fclose($file);
}

echo "biggest sum = " . $biggestSum;


?>