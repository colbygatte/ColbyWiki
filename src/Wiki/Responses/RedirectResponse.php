<?php

namespace Wiki\Responses;

use Wiki\Interfaces\ResponseInterface;

class RedirectResponse implements ResponseInterface
{
    public function __construct($redirect)
    {
    }
    
    /**
     * @return array
     */
    public function getHeaders()
    {
    
    }
    
    public function getBody()
    {
        return null;
    }
}