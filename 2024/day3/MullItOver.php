<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file) {
    $sum = 0;

    while ($line = trim(fgets($file))) {
        preg_match_all('/mul\((\d+),(\d+)\)/', $line, $matches, PREG_SET_ORDER);

        foreach ($matches as [$_, $a, $b]) {
            $sum += $a * $b;
        }
    }

    echo $sum;
});