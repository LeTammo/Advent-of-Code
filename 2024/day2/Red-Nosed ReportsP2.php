<?php

require_once './../../Misc.php';

runOnInputFile(static function ($file): void
{
    $saveReports = 0;

    while ($line = fgets($file)) {
        $report = explode(' ', trim($line));
        $line = trim($line);

        echo "-----------------\n";
        echo "Checking line [$line]\n";
        for ($i = 1, $iMax = count($report); $i < $iMax; $i++) {
            echo $report[$i] - $report[$i-1] . " ";
        }
        echo "\n";

        $result = checkReport($report);

        if (is_int($result)) {
            $val = $report[$result+1];
            echo "Problem found: $report[$result] (#$result) and $val (#" . ($result + 1) . ")\n";
        }

        if ($result !== true) {
            $reportA = $report;
            echo "Trying to remove $report[$result] (#$result)\n";
            unset($reportA[$result]);
            $newResult = checkReport(array_values($reportA));
            if ($newResult === true) {
                $val = $report[$result];
                echo "Removing $val (#$result)\n";
            }

            if ($newResult !== true) {
                $reportB = $report;
                $val = $report[$result + 1];
                echo "Trying to remove $val (#" . ($result + 1) . ")\n";
                unset($reportB[$result + 1]);
                $newResult = checkReport(array_values($reportB));
                if ($newResult === true) {
                    $val = $report[$result + 1];
                    echo "Removing $val (#$result)\n";
                }

                if ($newResult !== true && isset($report[$result - 1])) {
                    $reportB = $report;
                    $val = $report[$result - 1];
                    echo "Trying to remove $val (#" . ($result - 1) . ")\n";
                    unset($reportB[$result - 1]);
                    $newResult = checkReport(array_values($reportB));
                    if ($newResult === true) {
                        $val = $report[$result - 1];
                        echo "Removing $val (#$result)\n";
                    }
                }

                if ($newResult !== true) {
                    echo "No alternative found\n";
                    continue;
                }
            }
        }


        echo "Line is safe\n";
        $saveReports++;
    }

    echo $saveReports;
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