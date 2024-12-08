<?php

require_once './../../Misc.php';


$directions = [ [-1, 0], [0, 1], [1, 0], [0, -1] ];

runOnInputFile(static function ($file): void {
    global $directions;
    $field = [];
    $position = [];
    $direction = [];

    for ($i = 0; true; $i++) {
        if (!($line = trim(fgets($file)))) {
            break;
        }

        $row = str_split($line);
        $field[] = $row;
        foreach (["^", "v", "<", ">"] as $index => $char) {
            if ($j = array_search($char, $row)) {
                $position = [$i, $j];
                $direction = $directions[$index];
            }
        }
    }

    echo "Solution for Part 1: " . findPath($field, $directions, $position, $direction, $index) . PHP_EOL;
}, "input.txt");

function findPath(array $field, array $directions, array $position, array $direction, int $index): int
{
    $nextPosition = [];

    while (true) {
        $nextPosition[0] = $position[0] + $direction[0];
        $nextPosition[1] = $position[1] + $direction[1];

        $field[$position[0]][$position[1]] = "X";
        //echoField($field);

        if ($nextPosition[0] < 0 || $nextPosition[0] >= count($field) || $nextPosition[1] < 0 || $nextPosition[1] >= count($field[0])) {
            break;
        }

        if ($field[$nextPosition[0]][$nextPosition[1]] !== '#') {
            $position = $nextPosition;
            continue;
        }

        $index = ($index + 1) % 4;
        $direction = $directions[$index];
    }

    return array_sum(array_map(fn($row) => array_count_values($row)['X'] ?? 0, $field));
}

function echoField(array $field): void
{
    foreach ($field as $row) {
        echo implode("", $row) . PHP_EOL;
    }
    echo PHP_EOL;
}