<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void {
    $orderRules = [];

    while (($line = trim(fgets($file))) && $line !== "") {
        [$before, $after] = explode("|", trim($line));

        $orderRules[$before][] = $after;
        if (!isset($orderRules[$after])) {
            $orderRules[$after] = [];
        }
    }

    $correctlyOrderedUpdates = [];
    while (($line = trim(fgets($file)))) {
        $update = explode(",", trim($line));
        for ($i = 0; $i < count($update) - 1; $i++) {
            if (!in_array($update[$i + 1], $orderRules[$update[$i]])) {
                continue 2;
            }
        }
        $correctlyOrderedUpdates[] = $update;
    }

    $correctSum = array_sum(array_map(function ($correctlyOrderedUpdate) {
        return $correctlyOrderedUpdate[(count($correctlyOrderedUpdate) - 1) / 2];
    }, $correctlyOrderedUpdates));

    echo "Solution for Part 1: " . $correctSum . PHP_EOL;
}, "example.txt");