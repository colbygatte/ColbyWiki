<?php

namespace Wiki;

use Wiki\Interfaces\ResponseInterface as Response;

class Responder
{
    public function __construct()
    {
    }
    
    public function send(Response $response)
    {
        foreach ($response->getHeaders() as $header) {
            header($header);
        }
        
        echo $response->getBody();
    }
}