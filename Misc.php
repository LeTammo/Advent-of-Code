<?php

/**
 * @param callable $function
 * @return mixed
 */
function runOnInputFile(callable $function)
{
    if (!file_exists('input.txt')) {
        echo "Input file not found!" . PHP_EOL;
        exit;
    }

    $file = fopen('input.txt', 'r');

    $return = $function($file);

    fclose($file);

    return $return;
}
