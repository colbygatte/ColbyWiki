<?php

namespace Wiki\Responses;

use Wiki\Interfaces\ResponseInterface;

class BasicResponse implements ResponseInterface
{
    protected $body;
    
    public function getHeaders()
    {
        return PHP_SAPI == 'cli' ? [] : [
            'Content-type: plain-text'
        ];
    }
    
    public function setBody($body)
    {
        $this->body = $body;
        
        return $this;
    }
    
    public function getBody()
    {
        return $this->body;
    }
}