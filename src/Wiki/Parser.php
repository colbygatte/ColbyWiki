<?php

namespace Wiki;

class Parser
{
    const T_LINK_PAGE_EXISTS = 'LINK_PAGE_EXISTS';
    
    /**
     * @var \Wiki\Wiki
     */
    protected $wiki;
    
    /**
     * @var \Wiki\ParsedPageFactory
     */
    protected $parsedPageFactory;
    
    /**
     * @var \Wiki\TokenStyler
     */
    protected $tokenStyler;
    
    public function __construct(ParsedPageFactory $parsedPageFactory)
    {
        $this->parsedPageFactory = $parsedPageFactory;
    }
    
    /**
     * @param \Wiki\Wiki $wiki
     * @param \Wiki\TokenStyler $tokenStyler
     * @param $text
     *
     * @return \Wiki\ParsedPage
     */
    public function parse(Wiki $wiki, TokenStyler $tokenStyler, $text)
    {
        $this->wiki = $wiki;
        $this->tokenStyler = $tokenStyler;
        
        $text = preg_replace_callback(
            '/\[\[(.+?)\]\]/',
            [$this, 'handlePageMatches'],
            $text
        );
        
        return $this->parsedPageFactory->makeParsedPage()->setParsedText($text);
    
        $this->wiki = null;
        $this->tokenStyler = null;
    }
    
    public function handlePageMatches($matches)
    {
        $page = $matches[1];
        
        if( $this->wiki->pageExists($page)) {
            return $this->tokenStyler->pageNameThatExists($page, '#');
        }
    
        return $this->tokenStyler->pageNameThatDoesNotExist($page, '#');
    }
}