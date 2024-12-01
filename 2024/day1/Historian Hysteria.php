<?php

require_once './../../Misc.php';

runOnInputFile(function ($file) {
    $numbersLeft = [];
    $numbersRight = [];

    // parse the file line by line
    while ($line = fgets($file)) {
        [$numberLeft, $numberRight] = explode('   ', $line);
        $numbersLeft[] = (int)$numberLeft;
        $numbersRight[] = (int)$numberRight;
    }

    // sort both arrays
    sort($numbersLeft);
    sort($numbersRight);

    // calculate the distance of each pair
    $distance = 0;
    foreach ($numbersLeft as $key => $number) {
        $distance += abs($number - $numbersRight[$key]);
    }

    // result
    echo $distance;
});

/**
 * @param array $numbers
 * @return array
 *
 * Maybe I could implement this function to sort the array in a different way than using the built-in sort function.
 */
function customSort(array $numbers): array
{
    // TODO
}