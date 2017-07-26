<?php

namespace Wiki\Interfaces;

interface ResponseInterface
{
    public function getHeaders();
    
    public function getBody();
}