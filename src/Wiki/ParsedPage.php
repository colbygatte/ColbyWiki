<?php

namespace Wiki;

class ParsedPage
{
    protected $parsedText;
    
    public function setParsedText($parsedText) {
        $this->parsedText = $parsedText;
        
        return $this;
    }
    
    public function getParsedText()
    {
        return $this->parsedText;
    }
}