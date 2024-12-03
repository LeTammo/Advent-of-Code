<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void
{
    $programString = trim(stream_get_contents($file));

    $sum = 0;
    $pointerDo = 0;
    $pointerDont = strpos($programString, "don't()", $pointerDo);

    while ($pointerDo !== false) {
        $substring = substr($programString, $pointerDo, $pointerDont - $pointerDo);

        preg_match_all('/mul\((\d+),(\d+)\)/', $substring, $multiplications, PREG_SET_ORDER);

        $sum += array_sum(array_map(static fn($m) => $m[1] * $m[2], $multiplications));

        $pointerDo = strpos($programString, "do()", $pointerDont);
        $pointerDont = strpos($programString, "don't()", $pointerDo) ?: strlen($programString);
    }

    echo "Solution for Part 2: $sum\n";
});