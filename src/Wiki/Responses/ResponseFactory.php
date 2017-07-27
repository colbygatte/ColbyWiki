<?php

namespace Wiki\Responses;

class ResponseFactory
{
    public function basicResponse()
    {
        return new BasicResponse;
    }
    
    public function redirectResponse()
    {
        return new RedirectResponse;
    }
}