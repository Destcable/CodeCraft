<?php

function isContainBraces(string $str): bool
{
    return (strpos($str, '{') !== false) && (strpos($str, '}') !== false);
}