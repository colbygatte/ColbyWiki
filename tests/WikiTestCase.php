<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Wiki\Actions;
use Wiki\Controller;
use Wiki\Db;
use Wiki\Container;
use Wiki\Logger;
use Wiki\Parser;
use Wiki\Parser\ParsedPageFactory;
use Wiki\TemplateEngine;
use Wiki\Request;
use Wiki\Responder;
use Wiki\Responses\ResponseFactory;
use Wiki\Wiki;
use Wiki\WikiTextTokenStyler;

class WikiTestCase extends BaseTestCase
{
    /**
     * @var \Wiki\Container
     */
    protected $container;
    
    protected function makeContainer()
    {
        Container::setInstance(new Container(
            new Wiki(new Db(__DIR__.'/db')),
            
            new Request($_POST, $_GET),
            
            new TemplateEngine(__DIR__.'/../resources/views'),
            
            new Responder,
            
            new ResponseFactory(),
            
            new Parser(new ParsedPageFactory),
            
            new WikiTextTokenStyler,
            
            new Controller,
            
            new Logger('WikiLogger')
        ));
    }
    
    protected function setUp()
    {
        parent::setUp();
    }
}