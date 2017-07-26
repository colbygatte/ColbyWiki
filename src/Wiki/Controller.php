<?php

namespace Wiki;

use Wiki\Responses\CliResponse;

class Controller
{
    /**
     * @var \Wiki\Wiki
     */
    protected $wiki;
    
    /**
     * @var \Wiki\Request
     */
    protected $request;
    
    /**
     * @var \Wiki\Renderer
     */
    protected $renderer;
    
    /**
     * @var \Wiki\Responder
     */
    protected $responder;
    
    /**
     * @var \Wiki\Parser
     */
    protected $parser;
    
    /**
     * @var \Wiki\TokenStyler
     */
    protected $tokenStyler;
    
    /**
     * Controller constructor.
     *
     * @param \Wiki\Wiki $wiki
     * @param \Wiki\Request $request
     * @param \Wiki\Renderer $renderer
     * @param \Wiki\Responder $responder
     * @param \Wiki\Parser $parser
     * @param \Wiki\TokenStyler $tokenStyler
     */
    public function __construct(
        Wiki $wiki,
        Request $request,
        Renderer $renderer,
        Responder $responder,
        Parser $parser,
        TokenStyler $tokenStyler
    ) {
        $this->wiki = $wiki;
        $this->request = $request;
        $this->renderer = $renderer;
        $this->responder = $responder;
        $this->parser = $parser;
        $this->tokenStyler = $tokenStyler;
    }
    
    /**
     * @param $text
     *
     * @return \Wiki\ParsedPage
     */
    public function parseText($text)
    {
        return $this->parser->parse(
            $this->wiki,
            $this->tokenStyler,
            $text
        );
    }
    
    /**
     * @return \Wiki\Wiki
     */
    public function getWiki()
    {
        return $this->wiki;
    }
    
    /**
     * @return \Wiki\Parser
     */
    public function getParser()
    {
        return $this->parser;
    }
    
    /**
     * @return \Wiki\Request
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    /**
     *
     */
    public function run()
    {
        $this->responder->send(
            (new CliResponse)->setBody('heyyyy')
        );
    }
}