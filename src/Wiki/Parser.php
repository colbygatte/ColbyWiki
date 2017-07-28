<?php

namespace Wiki;

use Wiki\Extensions\BulmaParsedown;
use Wiki\Interfaces\ParserInterface;

class Parser extends ParserInterface
{
    const T_LINK_PAGE_EXISTS = 'LINK_PAGE_EXISTS';
    
    /**
     * @var \Wiki\Wiki
     */
    protected $wiki;
    
    /**
     * @var \Wiki\WikiTextTokenStyler
     */
    protected $tokenStyler;
    
    /**
     * @param \Wiki\Wiki $wiki
     * @param \Wiki\WikiTextTokenStyler $tokenStyler
     * @param $text
     *
     * @return \Wiki\Parser\ParsedPage
     */
    public function parse(Wiki $wiki, WikiTextTokenStyler $tokenStyler, $text)
    {
        $this->wiki = $wiki;
        $this->tokenStyler = $tokenStyler;
        
        $parsedown = new BulmaParsedown;
        
        $text = $parsedown->text($text);
        
        $text = preg_replace_callback(
            '/\[\[(.+?)\]\]/',
            [$this, 'handlePageMatches'],
            $text
        );
        
        $this->wiki = null;
        $this->tokenStyler = null;
        
        return $this->parsedPageFactory->makeParsedPage()->setParsedText($text);
    }
    
    public function handlePageMatches($matches)
    {
        $page = $matches[1];
        
        $url = http_path('?action=view_page&page='.$page);
        
        if ($this->wiki->pageExists($page)) {
            return $this->tokenStyler->pageNameThatExists($page, $url);
        }
        
        return $this->tokenStyler->pageNameThatDoesNotExist($page, $url);
    }
}