<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void {
    $orderRules = [];
    $notSorted = [];
    $updates = [];

    while (($line = trim(fgets($file))) && $line !== "") {
        [$before, $after] = explode("|", trim($line));

        // TODO: graph erstellen!
    }
    var_dump($orderRules, $notSorted);

    $correctlyOrderedUpdates = [];
    while (($line = trim(fgets($file)))) {
        $updates[] = explode(",", trim($line));
    }



    echo "Solution for Part 1: " . findOrderedMiddlePageSum($orderRules, $updates) . PHP_EOL;
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


