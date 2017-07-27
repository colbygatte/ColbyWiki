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
    
    protected $sections;
    
    protected $insideSection;
    
    protected $extendsFile;
    
    public function __construct($viewsDirectory)
    {
        $this->viewsDirectory = $viewsDirectory;
    }
    
    public function render($view, $templateVariables)
    {
        $this->extendsFile = null; // this function is recursive, make sure this is set back to nil
        
        $view = str_replace('.', '/', $view);
        
        $renderer = $this; // for use in template
        
        extract($templateVariables);
        
        ob_start();
        
        include $this->viewsDirectory.prepend_slash($view).'.php';
        
        $pageContent = ob_get_clean();
        
        // See if the content is an extension of another file
        
        if ($this->extendsFile) {
            return $this->render($this->extendsFile, $templateVariables);
        } else {
            return $pageContent;
        }
    }
    
    public function start($sectionName)
    {
        $this->insideSection = $sectionName;
        
        ob_start();
    }
    
    public function end()
    {
        $this->sections[$this->insideSection] = ob_get_clean();
    }
    
    public function yieldSection($section)
    {
        echo isset($this->sections[$section]) ? $this->sections[$section] : '';
    }
    
    public function extend($templateFile)
    {
        $this->extendsFile = $templateFile;
    }
}