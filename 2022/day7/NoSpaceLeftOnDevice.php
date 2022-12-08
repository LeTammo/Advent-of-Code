<?php

$file = fopen("input.txt", "r");
if ($file) {

    while ($line = fgets($file)) {
    }

    fclose($file);
}

?>