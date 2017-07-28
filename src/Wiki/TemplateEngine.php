<?php

namespace Wiki;

/**
 * Class Renderer
 *
 * @package Wiki
 */
class TemplateEngine
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
    
    /**
     * @param string $view Path to the layout file, excluding file extension. Periods (.) may be used in place of slashes (/).
     * @param $templateVariables Variables made available to the template
     *
     * @return string
     */
    public function render($view, $templateVariables)
    {
        $this->extendsFile = null; // This function is recursive, make sure this is set back to nil
        
        $view = str_replace('.', '/', $view);
        
        ob_start();
        
        extract($templateVariables);
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
        if (isset($this->extendsFile)) {
            throw new \Exception("A single file cannot extend more than one file");
        }
        
        $this->extendsFile = $templateFile;
    }
}