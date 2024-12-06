<?php

/**
 * @param callable $function
 * @param string $filename
 * @return mixed
 */
function runOnInputFile(callable $function, string $filename = 'input.txt'): mixed
{
    if (!file_exists($filename)) {
        echo "Input file not found!" . PHP_EOL;
        exit;
    }

    $file = fopen($filename, 'r');

    $return = $function($file);

    fclose($file);

    return $return;
}

function echoValues($array, $glue = ", ", $parentheses = "[]"): void
{
    echo ($parentheses[0] ?? "") . implode($glue, $array) . ($parentheses[1] ?? "") . PHP_EOL;
}