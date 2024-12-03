<?php

/**
 * @param callable $function
 * @param string $filename
 * @return void
 */
function runOnInputFile(callable $function, string $filename = 'input.txt')
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
