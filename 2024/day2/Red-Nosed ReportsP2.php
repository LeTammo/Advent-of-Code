<?php

require_once './../../Misc.php';

runOnInputFile(static function ($file): void
{
    $safeReports = 0;

    while ($line = fgets($file)) {
        $safeReports += parseAndCheckLine($line);
    }

    echo "Safe reports: $safeReports\n";
});

function parseAndCheckLine(string $line): bool
{
    // Parse the line to get the report
    $report = array_map('intval', explode(' ', trim($line)));

    // Check the report
    $result = checkReport($report);

    // If the result is valid, return true
    if (!is_int($result)) {
        return true;
    }

    // Test to remove the previous, current or next element
    foreach ([$result-1, $result, $result+1] as $indexToRemove) {
        // Skip if the index is out of bounds
        if (!isset($report[$indexToRemove])) {
            continue;
        }

        // Create a modified report excluding the current index
        $subReport = $report;
        unset($subReport[$indexToRemove]);

        // Re-index the array to avoid gaps in the keys and check the report
        if (is_bool(checkReport(array_values($subReport)))) {
            return true;
        }
    }

    return false;
}

function checkReport(array $report)
{
    $orderFactor = $report[0] < $report[1] ? 1 : -1;

    for ($i = 1, $max = count($report); $i < $max; $i++) {
        $distance = $orderFactor * ($report[$i] - $report[$i - 1]);
        if ($distance < 1 || $distance > 3) {
            return $i - 1;
        }
    }

    return true;
}