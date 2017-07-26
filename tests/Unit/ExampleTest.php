<?php

namespace Tests\Unit;

use Tests\TestCase;
use Wiki\Config;
use Wiki\Controller;
use Wiki\Db;
use Wiki\ParsedPageFactory;
use Wiki\Parser;
use Wiki\Renderer;
use Wiki\Request;
use Wiki\Responder;
use Wiki\TokenStyler;
use Wiki\Wiki;

class ExampleTest extends TestCase
{
    /** @test */
    public function test_wiki()
    {
        $wc = new Controller(
            new Wiki(new Db(__DIR__.'/../db')),
            
            new Request($_POST, $_GET),
            
            new Renderer,
            
            new Responder,
            
            new Parser(new ParsedPageFactory),
            
            new TokenStyler
        );
        
        $page = $wc->getWiki()->getPage('MainPage');
        
        $parsed = $wc->parseText($page->getText());
        
        dump__($parsed->getParsedText());
    }
}