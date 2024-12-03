<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void
{
    $safeReports = 0;

    while ($line = fgets($file)) {
        $safeReports += isValidReport($line);
    }

    echo "Safe reports: $safeReports\n";
});

/** Validates a report and checks if it can be corrected by removing one element. */
function isValidReport(string $line): bool
{
    // Parse the line to get the report
    $report = array_map('intval', explode(' ', trim($line)));

    // Check if the report is valid
    $invalidKey = checkForInvalidNumber($report);
    if (!$invalidKey) {
        return true;
    }

    // Try to correct the report by removing the previous, current, or next element
    foreach ([$invalidKey - 2, $invalidKey - 1, $invalidKey] as $indexToRemove) {
        // Create a modified report excluding the current index
        $subReport = $report;
        unset($subReport[$indexToRemove]);

        if (!checkForInvalidNumber(array_values($subReport))) {
            return true;
        }
    }

    return false;
}

/** Checks if a report is valid. */
function checkForInvalidNumber(array $report): int
{
    $orderFactor = $report[0] < $report[1] ? 1 : -1;

    for ($i = 1, $max = count($report); $i < $max; $i++) {
        $distance = $orderFactor * ($report[$i] - $report[$i - 1]);
        if ($distance < 1 || $distance > 3) {
            return $i; // Return the index of the irregular element
        }
    }

    return 0;
}