<?php

require_once './../../Misc.php';


$directions = [
    "^" => [-1, 0],
    ">" => [0, 1],
    "v" => [1, 0],
    "<" => [0, -1],
];

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
        foreach (["^", "v", "<", ">"] as $char) {
            if ($j = array_search($char, $row)) {
                $position = [$i, $j];
                $direction = $directions[$char];
            }
        }
    }

    echoValues($position, ", ");
    echoValues($direction, ", ");

    echo "Solution for Part 1: " . findPath($field, $directions, $position, $direction) . PHP_EOL;
}, "example.txt");

function findPath(array $field, array $directions, array $position, array $direction): int
{
    $nextPosition = [];
    $uniqueSteps = 0;

    while (true) {
        $nextPosition[0] = $position[0] + $direction[0];
        $nextPosition[1] = $position[1] + $direction[1];
        if ($nextPosition[0] < 0 || $nextPosition[0] >= count($field) || $nextPosition[1] < 0 || $nextPosition[1] >= count($field[0])) {
            break;
        }

        if ($field[$nextPosition[0]][$nextPosition[1]] !== '#') {
            $position = $nextPosition;
            $uniqueSteps++;
            continue;
        }

        next($directions);
        $field[$position[0]][$position[1]] = key($directions);
        $direction = current($directions);

        echo "Changed direction to: " . echoValues($direction) . PHP_EOL;
        sleep(1);
    }

    return $uniqueSteps;
}