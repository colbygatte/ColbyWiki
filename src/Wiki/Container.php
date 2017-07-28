<?php

namespace Wiki;

use Psr\Log\LoggerInterface;
use Wiki\Interfaces\AbstractController;
use Wiki\Responses\ResponseFactory;
use Wiki\Traits\Logger;

class Container
{
    use Logger;
    
    protected static $instance;
    
    /**
     * @var \Wiki\Wiki
     */
    protected $wiki;
    
    /**
     * @var \Wiki\Request
     */
    protected $request;
    
    /**
     * @var \Wiki\TemplateEngine
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
     * @var \Wiki\Container
     */
    protected $actionHandler;
    
    /**
     * @var \Wiki\Responses\ResponseFactory
     */
    protected $responseFactory;
    
    /**
     * Controller constructor.
     *
     * @param \Wiki\Wiki $wiki
     * @param \Wiki\Request $request
     * @param \Wiki\TemplateEngine $templateEngine
     * @param \Wiki\Responder $responder
     * @param \Wiki\Responses\ResponseFactory $responseFactory
     * @param \Wiki\Parser $parser
     * @param \Wiki\WikiTextTokenStyler $tokenStyler
     * @param \Wiki\Actions|\Wiki\Interfaces\AbstractController $actionHandler
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        Wiki $wiki,
        Request $request,
        TemplateEngine $templateEngine,
        Responder $responder,
        ResponseFactory $responseFactory,
        Parser $parser,
        WikiTextTokenStyler $tokenStyler,
        AbstractController $actionHandler,
        LoggerInterface $logger
    ) {
        $this->wiki = $wiki;
        $this->request = $request;
        $this->renderer = $templateEngine;
        $this->responder = $responder;
        $this->parser = $parser;
        $this->tokenStyler = $tokenStyler;
        $this->actionHandler = $actionHandler;
        $this->logger = $logger;
        $this->responseFactory = $responseFactory;
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
    
    /**
     * 1) See if there is a trigger
     * 2) Trigger will return a reponse
     * 3) Send response
     */
    public function parseCurrentRequest()
    {
        // If 'action' is post, data will only be read from 'post'
        if ($action = $this->request->post('action')) {
            die('"post" method action handling not implemented');
        }
        
        $action = $this->request->get('action') ?: 'home';
    
        if ($response = $this->actionHandler->trigger($action, $this)) {
            $this->getResponder()->send($response);
        } else {
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
     * @return \Wiki\TemplateEngine
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
    
    /**
     * @return \Wiki\Responses\ResponseFactory
     */
    public function getResponseFactory()
    {
        return $this->responseFactory;
    }
    
    public static function setInstance(Container $instance)
    {
        static::$instance = $instance;
    }
    
    public static function getInstance()
    {
        if (! static::$instance) {
            throw new \Exception('Instance not set');
        }
    
        return static::$instance;
    }
}