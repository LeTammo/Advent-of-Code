<?php

require_once 'Misc.php';
require_once './../Misc.php';
$file = readInputFile('input.txt');

$crates = readCrateInput($file);
$tmp = [];

while ($line = fgets($file)) {
    if (strpos($line, 'move') === false) {
        continue;
    }

    $matches = explode(' ', $line);
    $amount = (int)$matches[1];
    $from = ((int)$matches[3]) - 1;
    $to = ((int)$matches[5]) - 1;

    for ($i = 0; $i < $amount; $i++) {
        $tmp[] = array_pop($crates[$from]);
    }
    for ($i = 0; $i < $amount; $i++) {
        $crates[$to][] = array_pop($tmp);
    }
}
fclose($file);

$solution = "";
foreach ($crates as $crate) {
    $solution .= end($crate);
}
echo PHP_EOL . $solution . PHP_EOL;