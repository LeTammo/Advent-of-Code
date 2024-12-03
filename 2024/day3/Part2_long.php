<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void
{
    $programString = trim(stream_get_contents($file));

    // Find all occurrences of "do" and "don't"
    $dos = strpos_all($programString, "do()");
    $donts = strpos_all($programString, "don't()");

    // Add additional points to make the following loop easier
    array_unshift($dos, 0);
    array_unshift($donts, 0);
    $donts[] = strlen($programString) - 1;

    $sum = 0;
    $pointer_do = 0;
    $pointer_dont = 0;
    while ($pointer_do < count($dos) - 1 && $pointer_dont < count($donts) - 1) {
        // find the next relevant "do"
        while ($pointer_do < count($dos) - 1 && $dos[$pointer_do] < $donts[$pointer_dont]) {
            $pointer_do++;
        }
        // find the next relevant "don't"
        while ($pointer_dont < count($donts) - 1 && $donts[$pointer_dont] <= $dos[$pointer_do]) {
            $pointer_dont++;
        }

        // get the substring for the enabled multiplications
        $substring = substr($programString, $dos[$pointer_do], $donts[$pointer_dont] - $dos[$pointer_do]);

        // find all multiplications in the substring
        preg_match_all('/mul\((\d+),(\d+)\)/', $substring, $multiplications, PREG_SET_ORDER);

        // Calculate the sum
        $sum += array_sum(array_map(static fn($m) => $m[1] * $m[2], $multiplications));
    }

    echo "Solution for Part 2: $sum\n";
}, "input.txt");


/**
 * Works similar to strpos, but finds all occurrences of the needle in the haystack
 * and returns an array with their positions.
 *
 * @param $haystack
 * @param $needle
 * @return array
 */
function strpos_all($haystack, $needle): array
{
    $positions = [];

    $offset = 0;
    while (($pos = strpos($haystack, $needle, $offset)) !== FALSE) {
        $positions[] = $pos;
        $offset = $pos + strlen($needle);
    }

    return $positions;
}