<?php

namespace Wiki;

use Wiki\Interfaces\AbstractController;

class Controller extends AbstractController
{
    function actionHome(DependencyContainer $container)
    {
        
        $text = $container->getRenderer()->render('home', ['name' => 'IT WORKED!']);
        
        $response = (new Responses\BasicResponse)->setBody($text);
        
        $container->getResponder()->send($response);
        
        return static::ACTION_SUCCESS;
    }
}