<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Wiki\Actions;
use Wiki\Controller;
use Wiki\Db;
use Wiki\Db\ParsedPageFactory;
use Wiki\DependencyContainer;
use Wiki\Parser;
use Wiki\Renderer;
use Wiki\Request;
use Wiki\Responder;
use Wiki\Wiki;
use Wiki\WikiTextTokenStyler;

class WikiTestCase extends BaseTestCase
{
    /**
     * @var \Wiki\DependencyContainer
     */
    protected $container;
    
    protected function makeContainer()
    {
        return new DependencyContainer(
            new Wiki(new Db(__DIR__.'/db')),
            
            new Request($_POST, $_GET),
            
            new Renderer(__DIR__.'/../resources/views'),
            
            new Responder,
            
            new Parser(new ParsedPageFactory),
            
            new WikiTextTokenStyler,
            
            new Controller
        );
    }
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->makeContainer();
    }
}