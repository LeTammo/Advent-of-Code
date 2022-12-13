<?php

require_once './../Misc.php';
$file = readInputFile('input.txt');

$count = 0;

while ($line = fgets($file)) {
    $parts = explode(',', trim($line));
    $parts[0] = explode('-', $parts[0]);
    $parts[1] = explode('-', $parts[1]);

    if (($parts[0][0] <= $parts[1][0] && $parts[0][1] >= $parts[1][0])
        || ($parts[0][0] <= $parts[1][1] && $parts[0][1] >= $parts[1][1])
        || ($parts[0][0] <= $parts[1][0] && $parts[0][1] >= $parts[1][1])
        || ($parts[0][0] >= $parts[1][0] && $parts[0][1] <= $parts[1][1])) {
        echo 'overlap: ' . $line;
        $count++;
    } else {
        echo 'no overlap: ' . $line;
    }
}

fclose($file);

echo PHP_EOL . $count . PHP_EOL . PHP_EOL;

// a - b , c - d
// -----|ooooo|-------------
// ----------|ooooo|-----
// a <= c && (b >= c || b >= d)


// ----------|ooooo|-----
// -----|ooooo|-------------
// a <= d && b >= d


// -------|ooooo|-----
// -----|oooooooo|----
// a >= c && b <= d


// -----|oooooooo|-----
// ------|oooooo|----
// a <= c && b >= d
