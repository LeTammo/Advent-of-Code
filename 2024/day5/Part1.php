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
    $incorrectlyOrderedUpdates = [];
    while (($line = trim(fgets($file)))) {
        $update = explode(",", trim($line));
        for ($i = 0; $i < count($update) - 1; $i++) {
            if (!in_array($update[$i + 1], $orderRules[$update[$i]])) {
                for ($j = 0; $j < count($update) - 1; $j++) {
                    $tmp = $j;
                    while ($tmp < count($update) - 1 && in_array($update[$tmp], $orderRules[$update[$tmp + 1]])) {
                        $temp = $update[$tmp];
                        $update[$tmp] = $update[$tmp + 1];
                        $update[$tmp + 1] = $temp;
                        $tmp++;
                    }
                }

                $incorrectlyOrderedUpdates[] = $update;
                continue 2;
            }
        }
        $correctlyOrderedUpdates[] = $update;
    }

    $correctSum = array_sum(array_map(function ($correctlyOrderedUpdate) {
        return $correctlyOrderedUpdate[(count($correctlyOrderedUpdate) - 1) / 2];
    }, $correctlyOrderedUpdates));

    $incorrectSum = array_sum(array_map(function ($incorrectlyOrderedUpdate) {
        return $incorrectlyOrderedUpdate[(count($incorrectlyOrderedUpdate) - 1) / 2];
    }, $incorrectlyOrderedUpdates));

    echo "Solution for Part 1: " . $correctSum . PHP_EOL;
}, "example.txt");