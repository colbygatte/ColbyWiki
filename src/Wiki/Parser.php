<?php

namespace Wiki;

use Wiki\Db\ParsedPageFactory;

class Parser
{
    const T_LINK_PAGE_EXISTS = 'LINK_PAGE_EXISTS';
    
    /**
     * @var \Wiki\Wiki
     */
    protected $wiki;
    
    /**
     * @var \Wiki\Db\ParsedPageFactory
     */
    protected $parsedPageFactory;
    
    /**
     * @var \Wiki\WikiTextTokenStyler
     */
    protected $tokenStyler;
    
    public function __construct(ParsedPageFactory $parsedPageFactory)
    {
        $this->parsedPageFactory = $parsedPageFactory;
    }
    
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
        
        if ($this->wiki->pageExists($page)) {
            return $this->tokenStyler->pageNameThatExists($page, '#');
        }
        
        return $this->tokenStyler->pageNameThatDoesNotExist($page, '#');
    }
}