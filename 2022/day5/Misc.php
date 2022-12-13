<?php

/**
 * @param array $crates
 * @param int $from
 * @param int $to
 * @return void
 */
function printCrates(array $crates, int $from, int $to)
{
    echo 'Crate ' . $from . ' is ' . $crates[$from - 1] . ' and crate ' . $to . ' is ' . $crates[$to - 1] . PHP_EOL;
}

/**
 * @param array $crates
 * @return void
 */
function printPrettyCrates(array $crates)
{
    for ($i = count(max($crates)); $i >= 0; $i--) {
        foreach ($crates as $stack) {
            if (count($stack) > $i) {
                $crate = $stack[$i];
                echo "[$crate] ";
            } else {
                echo "    ";
            }
        }
        echo PHP_EOL;
    }
}

/**
 * @param $crates
 * @param $amount
 * @param $from
 * @param $to
 * @param $line
 * @return bool|void
 */
function validateMoving($crates, $amount, $from, $to, $line)
{
    if (strlen($crates[$from - 1]) < $amount) {
        echo $amount . PHP_EOL;
        echo 'Crate ' . $from . ' is ' . $crates[$from - 1] . ' and crate ' . $to . ' is ' . $crates[$to - 1] . PHP_EOL;
        echo 'Error: Crate ' . $from . ' does not have enough crates to move ' . $amount . ' crates to crate ' . $to . PHP_EOL;
        echo 'Invalid move at line "' . trim($line) . '"' . PHP_EOL;
        var_dump($crates);
        exit;
    }

    return true;
}

/**
 * @param $file
 * @return array
 */
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
            $crates = array_fill(0, $crateCount, []);
        }

        for ($i = 0; $i < $crateCount; $i++) {
            if ($line[1 + 4 * $i] !== ' ') {
                $crates[$i][] = $line[1 + 4 * $i];
            }
        }
    }

    foreach ($crates as $key => $crate) {
        $crates[$key] = array_reverse($crate);
    }

    return $crates;
}