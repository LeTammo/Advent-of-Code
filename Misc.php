<?php

/**
 * @param callable $function
 * @return mixed
 */
function runOnInputFile(callable $function, $filename = 'input.txt')
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
