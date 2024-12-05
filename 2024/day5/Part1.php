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

function findOrderedMiddlePageSum(array $pageOrderingRules, array $pageUpdateRules): int
{
    return false;

    /**
     *
     * 47|53
     * 97|13
     * 97|61
     * 97|47
     * 75|29
     * 61|13
     * 75|53
     * 29|13
     * 97|29
     * 53|29
     * 61|53
     * 97|53
     * 61|29
     * 47|13
     * 75|47
     * 97|75
     * 47|61
     * 75|61
     * 47|29
     * 75|13
     * 53|13
     *
     * 47, 53
     *
     */
}


