<?php

require_once './../../Misc.php';

runOnInputFile(static function ($file): void
{
    $safeReports = 0;

    while ($line = fgets($file)) {
        $report = array_map('intval', explode(' ', trim($line)));

        $result = checkReport($report);
        if (!is_int($result)) {
            $safeReports++;
            continue;
        }

        if (tryToFixReport($result, $report)) {
            $safeReports++;
        }
    }

    echo "$safeReports\n";
    echo $safeReports === 488 ? "All good\n" : "Something went wrong\n";
});

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

function tryToFixReport(int $result, array $report): bool
{
    $reportA = $report;
    unset($reportA[$result]);
    $newResult = checkReport(array_values($reportA));

    if ($newResult !== true) {
        $reportB = $report;
        unset($reportB[$result + 1]);
        $newResult = checkReport(array_values($reportB));

        if ($newResult !== true && isset($report[$result - 1])) {
            $reportB = $report;
            unset($reportB[$result - 1]);
            $newResult = checkReport(array_values($reportB));
        }

        if ($newResult !== true) {
            return false;
        }
    }

    return true;
}