<?php

namespace Wiki;

class Request
{
    public function __construct($post, $get)
    {
        $this->post = $post;
        $this->get = $get;
    }
    
    /**
     * @param $value
     * @param null $default
     *
     * @return null
     */
    function post($value, $default = null)
    {
        return isset($this->post[$value]) ? $this->post[$value] : $default;
    }
    
    /**
     * @param $value
     * @param null $default
     *
     * @return null
     */
    function get($value, $default = null)
    {
        return isset($this->get[$value]) ? $this->get[$value] : $default;
    }
}