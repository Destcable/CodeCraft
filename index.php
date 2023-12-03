<?php

$file = file_get_contents('test.json');
$file = json_decode($file);

foreach ($file->code as $item) {
    switch ($item->type) {
        case 'selector':
            $selector = $item->param_selector === "id" ? "#" : '.';
            echo 'document.querySelector("' . $selector .  $item->element. '")';
            break;
        default:
            echo "тип не найден";
            break;

    }

}