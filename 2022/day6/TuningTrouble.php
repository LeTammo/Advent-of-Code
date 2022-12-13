<?php

$content = file_get_contents('input.txt');

$startOfPacket = null;
$startOfMessage = null;
for ($i = 0; $i < strlen(trim($content)) - 3; $i++) {
    $packetValidator = substr($content, $i, 4);
    if (!$startOfPacket && count(array_unique(str_split($packetValidator))) < 4) {
        continue;
    } else if (!$startOfPacket) {
        $startOfPacket = $i + 4;
    }
    $messageValidator = substr($content, $i, 14);
    if (count(array_unique(str_split($messageValidator))) < 14) {
        continue;
    }
    $startOfMessage = $i + 14;
    break;
}
echo $startOfPacket . PHP_EOL;
echo $startOfMessage . PHP_EOL;