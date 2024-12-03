<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void
{
    $programString = trim(stream_get_contents($file));

    // find all multiplications
    preg_match_all('/mul\((\d+),(\d+)\)/', $programString, $multiplications, PREG_SET_ORDER);

    // calculate the sum
    $sum = array_sum(array_map(static fn($m) => $m[1] * $m[2], $multiplications));

    echo "Solution for Part 1: $sum\n";
});