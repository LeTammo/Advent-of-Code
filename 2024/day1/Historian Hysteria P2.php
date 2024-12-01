<?php

require_once './../../Misc.php';

runOnInputFile(function ($file) {
    $numbersLeft = [];
    $numbersRight = [];

    // parse the file line by line and directly calculate the occurrence of each number
    while ($line = fgets($file)) {
        [$numberLeft, $numberRight] = explode('   ', $line);
        $numbersLeft[] = (int)$numberLeft;

        // initialize the number or increment the occurrence
        $numbersRight[(int)$numberRight] = ($numbersRight[(int)$numberRight] ?? 0) + 1;
    }

    // calculate the "similarity score"
    $sum = 0;
    foreach ($numbersLeft as $number) {
        if (array_key_exists($number, $numbersRight)) {
            $sum += $number * $numbersRight[$number];
        }
    }

    // result
    echo $sum;
});