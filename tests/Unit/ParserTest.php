<?php

namespace Tests\Unit;

use Tests\WikiTestCase;

class ParserTest extends WikiTestCase
{
    /** @test */
    public function can_parse_links()
    {
        $this->makeContainer();
        
        $page = app()->getWiki()->getPage('MainPage');
        
        $parsed = app()->parseText($page->getText());
    
        $this->assertEquals(
            'hello my friend <a href="#" style="color:red;" href="#">dog</a>!!!',
            $parsed->getParsedText()
        );
    }
    
    /** @test */
    public function can_run_action()
    {
        $this->makeContainer();
        
        app()->run();
    }
}