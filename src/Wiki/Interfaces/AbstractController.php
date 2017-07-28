<?php

namespace Wiki\Interfaces;

use ColbyGatte\Utilities\StaticStr;
use http\Env\Response;
use Wiki\Container;

abstract class AbstractController
{
    /**
     * @param $action
     *
     * @return \Wiki\Interfaces\ResponseInterface
     */
    public function trigger($action)
    {
        $method = 'action'.StaticStr::upperCamelize($action);
        
        if (method_exists($this, $method)) {
            if (($body = $this->$method()) !== false) {
                if ($body instanceof ResponseInterface) {
                    return $body;
                }
                
                return app()->getResponseFactory()->basicResponse()->setBody($body);
            } else {
                die('error retrieving body from controller');
            }
        }
        
        die('error handling/error page not implemented');
    }
    
    abstract function actionHome();
}