<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void
{
    // Concatenate all lines of the file into a single string
    $programString = "";
    while ($line = trim(fgets($file))) {
        $programString .= $line;
    }

    $sum = 0;
    $pointerDo = 0;
    $pointerDont = 0;

    while ($pointerDo !== false) {
        // Find the next "don't()"
        $pointerDont = strpos($programString, "don't()", $pointerDo) ?: strlen($programString);

        // get the substring for the enabled multiplications
        $substring = substr($programString, $pointerDo, $pointerDont - $pointerDo);

        // find all multiplications in the substring and calculate the sum
        preg_match_all('/mul\((\d+),(\d+)\)/', $substring, $multiplications, PREG_SET_ORDER);
        foreach ($multiplications as [$_, $a, $b]) {
            $sum += $a * $b;
        }

        // Find the next "do()"
        $pointerDo = strpos($programString, "do()", $pointerDont);
    }

    echo "Solution for Part 2: $sum\n";
});