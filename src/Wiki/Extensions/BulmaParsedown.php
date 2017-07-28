<?php

namespace Wiki\Extensions;

use Parsedown as BaseParsedown;

class BulmaParsedown extends BaseParsedown
{
    protected function element(array $Element)
    {
        if (! isset($Element['attributes'])) {
            $Elements['attributes'] = [];
        }
        
        // Header
        if (in_array($Element['name'], ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])) {
            $headerNumber = $Element['name'][1];
            
            $Element['attributes']['class'] = "title is-{$headerNumber}";
        }
        
        return parent::element($Element);
    }
}