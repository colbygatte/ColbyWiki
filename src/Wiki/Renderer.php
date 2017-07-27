<?php

namespace Wiki;

use Wiki\Template\TemplateComponentContainer;

/**
 * Class Renderer
 *
 * @package Wiki
 */
class Renderer
{
    /**
     * @var string
     */
    protected $viewsDirectory;
    
    public function __construct($viewsDirectory)
    {
        $this->viewsDirectory = $viewsDirectory;
    }
    
    public function render($view, $templateVariables)
    {
        $view = str_replace('.', '/', $view);
    
        extract($templateVariables);
    
        ob_start();
    
        include $this->viewsDirectory.prepend_slash($view).'.php';
        
        return ob_get_clean();
    }
}