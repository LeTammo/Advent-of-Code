<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void {
    $wordGrid = [];
    while ($line = fgets($file)) {
        $wordGrid[] = str_split(trim($line));
    }

    echo "Solution for Part 1: " . findXmasAppearances($wordGrid) . PHP_EOL;
}, "input.txt");

function findXmasAppearances(array $wordGrid): int
{
    $xmasAppearances = 0;
    for ($i = 1, $iMax = count($wordGrid); $i < $iMax - 1; $i++) {
        for ($j = 1, $jMax = count($wordGrid[$i]); $j < $jMax - 1; $j++) {
            $combination = $wordGrid[$i - 1][$j - 1] . $wordGrid[$i - 1][$j + 1] . $wordGrid[$i + 1][$j - 1] . $wordGrid[$i + 1][$j + 1];

            if ($wordGrid[$i][$j] === "A" && in_array($combination, ["MSMS", "MMSS", "SMSM", "SSMM"], true)) {
                $xmasAppearances++;
            }
        }
    }

    return $xmasAppearances;
}