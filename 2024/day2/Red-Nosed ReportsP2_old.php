<?php

require_once './../../Misc.php';

runOnInputFile(static function ($file) {
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

        $orderFactor = $report[0] < $report[1] ? 1 : -1;
        $unsafeFound = false;

        for ($i = 1, $iMax = count($report); $i < $iMax; $i++) {
            if (findAnomalies($orderFactor, $report[$i], $report[$i-1])) {
                if ($unsafeFound) {
                    echo "This is bad\n";
                    continue 2;
                }
                if (array_key_exists($i+1, $report) && findAnomalies($orderFactor, $report[$i+1], $report[$i-1])) {
                    echo "This is bad\n";
                    continue 2;
                }
                $unsafeFound = true;
                echo "Found unsafe at $i\n";
                echo "Removing $report[$i] (#$i)\n";
            }
        }

        echo "Line is safe now\n";
        $saveReports++;
    }

    echo $saveReports;
});

/**
 * @param int $orderFactor
 * @param int $levelA
 * @param int $levelB
 * @return bool
 */
function findAnomalies(int $orderFactor, int $levelA, int $levelB): bool
{
    $distance = $orderFactor * ($levelA - $levelB);
    return ($distance < 1 || $distance > 3);
}