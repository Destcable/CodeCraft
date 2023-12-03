<?php
require 'vendor/autoload.php';

$file = file_get_contents('test.json');
$file = json_decode($file);
$code = [];

foreach ($file->code as $item) {
    switch ($item->type) {
        case 'if':
            $param_1 = isContainBraces($item->param_1) ? 'var_' . removeBraces($item->param_1) : $item->param_1;
            $param_2 = isContainBraces($item->param_2) ? 'var_' . removeBraces($item->param_2) : $item->param_2;
            $lineCode = 'if (' . $param_1 . ' ' . $item->operator . ' ' . $param_2 . ') {}';
            array_push($code, $lineCode);
            break;
        case 'selector':
            $selector = $item->param_selector === "id" ? "#" : '.';
            $lineCode = 'let var_' . $item->id . ' = document.querySelector("' . $selector .  $item->element. '");';
            array_push($code, $lineCode);
            break;
        case 'get_value':
            $lineCode = 'let var_' . $item->id . ' = ' . 'var_' . $item->element_id . '.value;';
            array_push($code, $lineCode);
            break;
        default:
            echo "тип не найден";
            break;

    }

}

$code = implode("\n", $code);
file_put_contents('compileJS/script.js', $code);

function isContainBraces(string $str): bool
{
    return (strpos($str, '{') !== false) && (strpos($str, '}') !== false);
}

function removeBraces(string $str): string
{
    return str_replace(['{', '}'], '',$str);
}