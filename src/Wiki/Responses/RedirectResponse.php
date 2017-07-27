<?php

namespace Wiki\Responses;

use Wiki\Interfaces\ResponseInterface;

class RedirectResponse implements ResponseInterface
{
    protected $redirect;
    
    public function __construct()
    {
    }
    
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }
    
    /**
     * @return array
     */
    public function getHeaders()
    {
        return ["Redirect: {$this->redirect}"];
    }
    
    public function getBody()
    {
        return null;
    }
}