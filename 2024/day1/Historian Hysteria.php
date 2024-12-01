<?php

require_once './../../Misc.php';

runOnInputFile(function ($file) {
    $numbersLeft = [];
    $numbersRight = [];
    while ($line = fgets($file)) {
        [$numberLeft, $numberRight] = explode('   ', $line);
        $numbersLeft[] = (int)$numberLeft;
        $numbersRight[] = (int)$numberRight;
    }

    sort($numbersLeft);
    sort($numbersRight);

    $distance = 0;
    foreach ($numbersLeft as $key => $number) {
        $distance += abs($number - $numbersRight[$key]);
    }

    echo $distance;
});

function qicksort(array $numbers): array
{
    // TODO
}