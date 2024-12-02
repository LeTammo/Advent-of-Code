<?php

require_once './../../Misc.php';

runOnInputFile(static function ($file): void
{
    $safeReports = 0;

    while ($line = fgets($file)) {
        $safeReports += checkLine($line);
    }

    echo "Safe reports: $safeReports\n";
});

function checkLine(string $line): bool
{
    $report = array_map('intval', explode(' ', trim($line)));

    $result = checkReport($report);
    if (!is_int($result)) {
        return true;
    }

    return tryToFixReport($result, $report);
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