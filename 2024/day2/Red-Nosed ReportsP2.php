<?php

require_once './../../Misc.php';

/**
 * Helper function from Misc.php to read the file called "input.txt"
 */
runOnInputFile(static function ($file): void
{
    $safeReports = 0;

    while ($line = fgets($file)) {
        $safeReports += isSafeReport($line);
    }

    echo "Safe reports: $safeReports\n";
});

/**
 * Validates a report and checks if it can be corrected by removing one element.
 */
function isSafeReport(string $line): bool
{
    // Parse the line to get the report
    $report = array_map('intval', explode(' ', trim($line)));

    // Check if the report is valid
    $result = isValidReport($report);
    if ($result === true) {
        return true;
    }

    // Try to correct the report by removing the previous, current, or next element
    foreach ([$result - 1, $result, $result + 1] as $indexToRemove) {
        if (!isset($report[$indexToRemove])) {
            continue;
        }

        // Create a modified report excluding the current index
        $subReport = $report;
        unset($subReport[$indexToRemove]);

        if (isValidReport(array_values($subReport)) === true) {
            return true;
        }
    }

    return false;
}

/**
 * Checks if a report is valid.
 *
 * @return int|bool Returns `true` if valid, or the index of the problematic element.
 */
function isValidReport(array $report)
{
    if (count($report) < 2) {
        return true; // Not part of the problem, but could be considered valid/invalid
    }

    $orderFactor = $report[0] < $report[1] ? 1 : -1;

    for ($i = 1, $max = count($report); $i < $max; $i++) {
        $distance = $orderFactor * ($report[$i] - $report[$i - 1]);
        if ($distance < 1 || $distance > 3) {
            return $i - 1; // Return the index of the offending element
        }
    }

    return true;
}