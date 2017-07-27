<?php

namespace Tests\Unit;

use Tests\WikiTestCase;

class ParserTest extends WikiTestCase
{
    /** @test */
    public function can_parse_links()
    {
        $container = $this->makeContainer();
        
        $page = $container->getWiki()->getPage('MainPage');
        
        $parsed = $container->parseText($page->getText());
    
        $this->assertEquals(
            'hello my friend <a href="#" style="color:red;" href="#">dog</a>!!!',
            $parsed->getParsedText()
        );
    }
    
    /** @test */
    public function can_run_action()
    {
        $container = $this->makeContainer();
        
        $container->run();
    }
}