<?php

namespace Wiki;

use Wiki\Interfaces\AbstractController;
use Wiki\Responses\CliResponse;

class DependencyContainer
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
     * @var \Wiki\WikiTextTokenStyler
     */
    protected $tokenStyler;
    
    /**
     * @var \Wiki\DependencyContainer
     */
    protected $actionHandler;
    
    /**
     * Controller constructor.
     *
     * @param \Wiki\Wiki $wiki
     * @param \Wiki\Request $request
     * @param \Wiki\Renderer $renderer
     * @param \Wiki\Responder $responder
     * @param \Wiki\Parser $parser
     * @param \Wiki\WikiTextTokenStyler $tokenStyler
     * @param \Wiki\Actions $actionHandler
     */
    public function __construct(
        Wiki $wiki,
        Request $request,
        Renderer $renderer,
        Responder $responder,
        Parser $parser,
        WikiTextTokenStyler $tokenStyler,
        AbstractController $actionHandler
    ) {
        $this->wiki = $wiki;
        $this->request = $request;
        $this->renderer = $renderer;
        $this->responder = $responder;
        $this->parser = $parser;
        $this->tokenStyler = $tokenStyler;
        $this->actionHandler = $actionHandler;
    }
    
    /**
     * @param $text
     *
     * @return \Wiki\Parser\ParsedPage
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
        $this->parseCurrentRequest();
    }
    
    public function parseCurrentRequest()
    {
        // If 'action' is post, data will only be read from 'post'
        if ($action = $this->request->post('action')) {
            die('"post" method action handling not implemented');
        }
        
        $action = $this->request->post('action') ?: 'home';
        
        if (! $this->actionHandler->trigger($action, $this)) {
            die('404 not implemented');
        }
    }
    
    /**
     * @return \Wiki\Actions
     */
    public function getActionHandler()
    {
        return $this->actionHandler;
    }
    
    /**
     * @return \Wiki\Renderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }
    
    /**
     * @return \Wiki\Responder
     */
    public function getResponder()
    {
        return $this->responder;
    }
}