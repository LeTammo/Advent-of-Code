<?php

/**
 * @param string $filename
 * @return false|resource|void
 */
function readInputFile(string $filename)
{
    if (!file_exists($filename)) {
        echo "Input file not found!" . PHP_EOL;
        exit;
    }

    return  fopen($filename, 'r');
}