<?php

namespace Wiki\Interfaces;

use Wiki\DependencyContainer;

abstract class AbstractController
{
    const ACTION_SUCCESS = 'success';
    
    const ACTION_NOT_FOUND = 'action_not_found';
    
    /**
     * @param $action
     * @param \Wiki\DependencyContainer $container
     *
     * @return string ACTION_ code
     */
    public function trigger($action, DependencyContainer $container)
    {
        if (method_exists($this, $method = 'action'.ucfirst($action))) {
            if (($body = $this->$method($container)) !== false) {
                $container->getResponder()->send(
                    $container->getResponseFactory()->basicResponse()->setBody($body)
                );
                
                return true;
            } else {
                die('error retrieving body from controller');
            }
        }
        
        die('error handling/error page not implemented');
    }
    
    abstract function actionHome(DependencyContainer $container);
}