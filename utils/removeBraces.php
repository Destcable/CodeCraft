<?php

function removeBraces(string $str): string
{
    return str_replace(['{', '}'], '',$str);
}