<?php

$filename = "input2.txt";

if(!file_exists($filename)) {
    echo "Input file not found!" . PHP_EOL;
    exit;
}

$file = fopen($filename, "r");

$trees = [];
while ($line = fgets($file)) {
    $trees[] = trim($line);
}

fclose($file);

$obstructions = $trees;

var_dump("2" > "#");
for ($i = 1; $i < count($trees) - 1; $i++) {
    for ($j = 1; $j < strlen($trees[$i]) - 1; $j++) {
        if ($trees[$i - 1][$j] > $trees[$i][$j]) {
            $obstructions[$i - 1][$j] = "#";
        }
        var_dump($trees[$i-1][$j]);
        var_dump($trees[$i][$j-1]);
        var_dump($trees[$i+1][$j]);
        var_dump($trees[$i][$j+1]);
        exit;
    }
}