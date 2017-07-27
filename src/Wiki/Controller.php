<?php

namespace Wiki;

use Wiki\Interfaces\AbstractController;

class Controller extends AbstractController
{
    function actionHome(DependencyContainer $container)
    {
        $mainPage = $container->getWiki()->getPage('MainPage');
        
        $parsedText = $container->parseText($mainPage->getText());
        
        return $container->getRenderer()->render('home', [
            'name' => $parsedText->getParsedText()
        ]);
    }
}