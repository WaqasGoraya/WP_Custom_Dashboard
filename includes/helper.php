<?php

class Debug
{
    public static function print($arg)
    {
        echo '<pre>';
        print_r($arg);
        die();
    }
}