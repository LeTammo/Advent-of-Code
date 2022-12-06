<?php

$file = fopen('input.txt', 'rb');

if ($file) {
    $crates = readCrateInput($file);
    fgets($file);

    while ($line = fgets($file)) {
        if (strpos($line, 'move') === false) {
            echo "Error: The line doesn't have a move command: '$line'";
            exit;
        }

        preg_match('/move (\d+) from (\d+) to (\d+)/', $line, $matches);
        $amount = (int)$matches[1];
        $from = (int)$matches[2];
        $to = (int)$matches[3];

        validateMoving($crates, $amount, $from, $to, $line);

        $currentMoving = substr($crates[$from-1], 0, $amount);
        $crates[$from-1] = str_replace($currentMoving, '', $crates[$from-1]);
        $crates[$to-1] = strrev($currentMoving) . $crates[$to-1];

        echo "Amount: $amount - From: $from - To: $to - String: $currentMoving" . PHP_EOL;
        printPrettyCrates($crates);
    }
    fclose($file);

    $solution = "";
    foreach ($crates as $crate) {
        if (strlen($crate) !== 0) {
            $solution .= $crate[0];
        }
    }
    echo PHP_EOL . $solution . PHP_EOL;
}

function printCrates(array $crates, int $from, int $to)
{
    echo 'Crate ' . $from . ' is ' . $crates[$from-1] . ' and crate ' . $to . ' is ' . $crates[$to-1] . PHP_EOL;
}

function printPrettyCrates(array $crates)
{
    for ($i = -1 + max(array_map(static fn ($crate) => strlen($crate), $crates)); $i >= 0; $i--) {
        foreach ($crates as $crate) {
            if (strlen($crate) > $i) {
                $crate = strrev($crate)[$i];
                echo "[$crate] ";
            } else {
                echo "    ";
            }
        }
        echo PHP_EOL;
    }
}

function validateMoving($crates, $amount, $from, $to, $line)
{
    if (strlen($crates[$from-1]) < $amount) {
        echo $amount . PHP_EOL;
        echo 'Crate ' . $from . ' is ' . $crates[$from-1] . ' and crate ' . $to . ' is ' . $crates[$to-1] . PHP_EOL;
        echo 'Error: Crate ' . $from . ' does not have enough crates to move ' . $amount . ' crates to crate ' . $to . PHP_EOL;
        echo 'Invalid move at line "' . trim($line) . '"' . PHP_EOL;
        var_dump($crates);
        exit;
    }

    return true;
}

function readCrateInput($file): array
{
    $crates = null;
    $crateCount = null;

    while ($line = fgets($file)) {
        if (!strpos($line, ']')) {
            break;
        }

        if (!$crates) {
            $crateCount = (int)ceil(strlen($line) / 4);
            $crates = array_fill(0, $crateCount, '');
        }

        for ($i = 0; $i < $crateCount; $i++) {
            if ($line[1+4*$i] !== ' ') {
                $crates[$i] .= $line[1+4*$i];
            }
        }
    }

    return $crates;
}