<?php

use Wiki\Config;
use Wiki\Controller;
use Wiki\Renderer;
use Wiki\Request;
use Wiki\Responder;
use Wiki\Wiki;

if (! function_exists('basic_request')) {
    function basic_request()
    {
        (new Controller(
            new Wiki(new Config),
            new Request($_POST, $_GET),
            new Renderer,
            new Responder
        ))->run();
    }
}

if (! function_exists('wiki_name')) {
    function wiki_name($name)
    {
        $name = preg_replace('/\h+/', '_', $name);
        return preg_replace('/[^\w0-9_]/', '', $name);
    }
}

if (! function_exists('is_wiki_name')) {
    function is_wiki_name($name)
    {
         return !preg_match('/[^\w0-9_]/', $name) ? true : false;
    }
}