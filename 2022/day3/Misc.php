<?php

function getLetterToInt(string $letter): int
{
    if (ord($letter) > 90) {
        return ord($letter) - 96;
    }
    return ord($letter) - 38;
}