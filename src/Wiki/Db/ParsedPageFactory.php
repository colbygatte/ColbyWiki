<?php

namespace Wiki\Db;

use Wiki\Parser\ParsedPage;

class ParsedPageFactory
{
    public function makeParsedPage()
    {
        return new ParsedPage;
    }
}