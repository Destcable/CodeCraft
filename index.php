<?php
require 'vendor/autoload.php';

use Languages\JavaScript;

$file = file_get_contents('test.json');
$file = json_decode($file);
$code = [];

foreach ($file->code as $item) {
    switch ($item->type) {
        case 'if':
            array_push($code, JavaScript::if($item));
            break;
        case 'selector':
            array_push($code, JavaScript::querySelector($item));
            break;
        case 'get_value':
            array_push($code, JavaScript::get_value($item));
            break;
        default:
            echo "тип не найден";
            break;

    }

}

$code = implode("\n", $code);
file_put_contents('compileJS/script.js', $code);