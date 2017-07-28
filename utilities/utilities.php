<?php

use Wiki\Container;
use Wiki\Responses\RedirectResponse;
use Wiki\Wiki\WikiPage;

if (! function_exists('app')) {
    /**
     * @return \Wiki\Container
     */
    function app()
    {
        return Container::getInstance();
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
        return ! preg_match('/[^\w0-9_]/', $name) ? true : false;
    }
}


if (! function_exists('view')) {
    /**
     * @param \Wiki\Container $container
     * @param $page
     * @param array $with
     *
     * @return string
     */
    function view($page, $with = [])
    {
        return app()->getRenderer()->render($page, $with);
    }
}

if (! function_exists('http_path')) {
    function http_path($append = '')
    {
        return WIKI_PUB_ROOT.prepend_slash($append);
    }
}

if (! function_exists('redirect')) {
    function redirect($path)
    {
        return (new RedirectResponse())->setRedirect($path);
    }
}

if (! function_exists('template')) {
    /**
     * @return \Wiki\TemplateEngine
     */
    function template()
    {
        return app()->getRenderer();
    }
}

if (! function_exists('page')) {
    /**
     * @param $page
     *
     * @return \Wiki\Wiki\WikiPage
     */
    function page($page)
    {
        return app()->getWiki()->getPage($page);
    }
}

if (! function_exists('request')) {
    function request($key)
    {
        if (is_array($key)) {
            $request = [];
            
            foreach ($key as $_key) {
                $request[$_key] = request($key);
            }
            
            return $request;
        }
        
        if ($value = app()->getRequest()->post($key)) {
            return $value;
        }
        
        if ($value = app()->getRequest()->get($key)) {
            return $value;
        }
        
        return false;
    }
}

if (! function_exists('parse')) {
    /**
     * @param $page
     *
     * @return \Wiki\Parser\ParsedPage
     */
    function parse($page)
    {
        if (is_string($page)) {
            $page = app()->getWiki()->getPage($page);
        }
        
        return app()->parseText($page->getText());
    }
}
