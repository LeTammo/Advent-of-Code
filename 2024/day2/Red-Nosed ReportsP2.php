<?php

require_once './../../Misc.php';

runOnInputFile(static function ($file): void
{
    $safeReports = 0;

    while ($line = fgets($file)) {
        $report = array_map('intval', explode(' ', trim($line)));

        $result = checkReport($report);

        if ($result !== true) {
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
                    continue;
                }
            }
        }

        $safeReports++;
    }

    echo $safeReports . "\n";

    if ($safeReports !== 488) {
        echo "Something went wrong\n";
    } else {
        echo "All good\n";
    }
});

function checkReport(array $report)
{
    $orderFactor = $report[0] < $report[1] ? 1 : -1;

    for ($i = 1, $iMax = count($report); $i < $iMax; $i++) {
        $distance = $orderFactor * ($report[$i] - $report[$i-1]);
        if ($distance < 1 || $distance > 3) {
            return $i - 1;
        }
    }

    return true;
}