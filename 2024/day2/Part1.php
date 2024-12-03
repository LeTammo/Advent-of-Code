<?php

require_once './../../Misc.php';

runOnInputFile(static function ($file) {
    $saveReports = 0;

    while ($line = fgets($file)) {
        $report = explode(' ', $line);

        // determine if the report needs to be ascended or descended
        $orderFactor = $report[0] < $report[1] ? 1 : -1;

        for ($i = 1, $iMax = count($report); $i < $iMax; $i++) {
            $distance = $orderFactor * ($report[$i] - $report[$i - 1]);
            if ($distance < 1 || $distance > 3) {
                continue 2;
            }
        }

        $saveReports++;
    }

    echo $saveReports;
}, "input.txt");
