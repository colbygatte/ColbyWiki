<?php

namespace Wiki\Responses;

use Wiki\Interfaces\ResponseInterface;

class CliResponse implements ResponseInterface
{
    protected $body;
    
    public function getHeaders()
    {
        return [];
    }
    
    public function getBody()
    {
        return $this->body;
    }
    
    /**
     * @param mixed $body
     *
     * @return CliResponse
     */
    public function setBody($body)
    {
        $this->body = $body;
        
        return $this;
    }
}