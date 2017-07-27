<?php

namespace Wiki\Interfaces;

use Wiki\DependencyContainer;

abstract class AbstractController
{
    const ACTION_SUCCESS = 'success';
    
    const ACTION_NOT_FOUND = 'action_not_found';
    
    /**
     * @param $action
     * @param \Wiki\DependencyContainer $controller
     *
     * @return string ACTION_ code
     */
    public function trigger($action, DependencyContainer $controller)
    {
        if (method_exists($this, $method = 'action'.ucfirst($action))) {
            return $this->$method($controller);
        }
        
        return static::ACTION_NOT_FOUND;
    }
    
    abstract function actionHome(DependencyContainer $container);
}