<?php

namespace Wiki;

use Wiki\Interfaces\ResponseInterface;

class Responder
{
    public function __construct()
    {
    }
    
    public function send(ResponseInterface $response)
    {
        foreach ($response->getHeaders() as $header) {
            header($header);
        }
        
        echo $response->getBody();
    }
}