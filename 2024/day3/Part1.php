<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void
{
    // concatenate all lines of the file
    $programString = "";
    while ($line = trim(fgets($file))) {
        $programString .= $line;
    }

    // find all multiplications
    preg_match_all('/mul\((\d+),(\d+)\)/', $programString, $multiplications, PREG_SET_ORDER);

    // calculate the sum
    $sum = 0;
    foreach ($multiplications as [$_, $a, $b]) {
        $sum += $a * $b;
    }

    echo "Solution for Part 1: $sum\n";
});