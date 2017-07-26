<?php

if (! function_exists('dump__')) {
    /**
     * Trailing '__' for finding when you took a dump somewhere & cannot remember where
     */
    function dump__()
    {
        if(function_exists('dump')) {
            dump(func_get_args());
        } else {
            print_r(func_get_args());
        }
    }
}

if (! function_exists('pause__')) {
    /**
     * Trailing '__' for finding when you paused somewhere & cannot remember where
     */
    function pause__(...$args)
    {
        if ($args) {
            if (function_exists('dump')) {
                dump($args);
            } else {
                print_r($args);
            }
        }
    
        echo 'PAUSED! Type anything character die or hit enter to continue ';
    
        trim(fgets(fopen('php://stdin', 'r'))) && die;
    }
}

if (! function_exists('catch_thrown_message')) {
    function catch_thrown_message(callable $callback)
    {
        try {
            $callback();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}