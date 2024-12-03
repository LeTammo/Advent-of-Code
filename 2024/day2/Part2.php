<?php

require_once './../../Misc.php';


runOnInputFile(static function ($file): void
{
    $safeReports = 0;

    while ($line = fgets($file)) {
        $safeReports += isValidReport($line);
    }

    echo "Safe reports: $safeReports\n";
}, "input.txt");

/** Validates a report and checks if it can be corrected by removing one element. */
function isValidReport(string $line): bool {
    $report = array_map('intval', explode(' ', trim($line)));

    $invalidIndex = findInvalidIndex($report);

    if (!$invalidIndex) {
        return true;
    }

    return tryCorrectingReport($report, $invalidIndex);
}

/** Tries to correct the report by removing one element. */
function tryCorrectingReport(array $report, int $invalidIndex): bool {
    $possibleRemovalIndices = [$invalidIndex, $invalidIndex - 1, $invalidIndex - 2];

    foreach ($possibleRemovalIndices as $indexToRemove) {
        $subReport = array_merge(array_slice($report, 0, $indexToRemove), array_slice($report, $indexToRemove + 1));

        if (!findInvalidIndex($subReport)) {
            return true;
        }
    }

    return false;
}

/** Checks if a report is valid and returns the index of the first invalid element. */
function findInvalidIndex(array $report): int {
    $orderFactor = $report[0] < $report[1] ? 1 : -1;

    for ($i = 1, $max = count($report); $i < $max; $i++) {
        $distance = $orderFactor * ($report[$i] - $report[$i - 1]);
        if ($distance < 1 || $distance > 3) {
            return $i;
        }
    }

    return 0;
}