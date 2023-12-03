<?php

namespace Languages;

require_once 'utils/isContainBraces.php';
require_once 'utils/removeBraces.php';

class JavaScript
{
    public static function if($item): string
    {
        $param_1 = isContainBraces($item->param_1) ? 'var_' . removeBraces($item->param_1) : $item->param_1;
        $param_2 = isContainBraces($item->param_2) ? 'var_' . removeBraces($item->param_2) : $item->param_2;
        $then = PHP_EOL . self::if_then($item->then) . PHP_EOL;

        if ($param_2) { 
            $condition = 'if (' . $param_1 . ' ' . $item->operator . ' ' . $param_2 . ')';
        } else {
            $condition = 'if (' . $param_1 . ')';
        }

        if ($item->catch) {
            $catch = PHP_EOL . self::if_catch($item->catch) . PHP_EOL;
            return  $condition . ' {' . $then .'} else {' . $catch . '}';
        }

        return  $condition . ' {' . $then .'}';
    }

    public static function querySelector($item): string
    {
        $selector = $item->param_selector === "id" ? "#" : '.';
        return 'let var_' . $item->id . ' = document.querySelector("' . $selector .  $item->element. '");';
    }

    public static function if_then($item)
    {
        switch ($item->type) {
            case 'console_log':
                return self::console_log($item);
        }
    }

    public static function if_catch($item)
    {
        switch ($item->type) {
            case 'console_log':
                return self::console_log($item);
        }
    }

    public static function console_log($item): string
    {
        return 'console.log(' . '"' . $item->message . '"' . ')';
    }

    public static function get_value($item): string
    {
        return 'let var_' . $item->id . ' = ' . 'var_' . $item->element_id . '.value;';
    }
}