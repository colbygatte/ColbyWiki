<?php

namespace Wiki\Interfaces;

use Wiki\Parser\ParsedPageFactory;
use Wiki\Wiki;
use Wiki\WikiTextTokenStyler;

abstract class ParserInterface
{
    protected $parsedPageFactory;
    
    public function __construct(ParsedPageFactory $parsedPageFactory)
    {
        $this->parsedPageFactory = $parsedPageFactory;
    }
    
    abstract public function parse(Wiki $wiki, WikiTextTokenStyler $tokenStyler, $text);
}