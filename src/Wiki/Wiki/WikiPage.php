<?php

namespace Wiki\Wiki;

use Wiki\DbPageDirectory;

/**
 * All information about a WikiPage should be accessed through this class.
 *
 * @package Wiki\Wiki
 */
class WikiPage
{
    /**
     * @var \Wiki\DbPageDirectory
     */
    protected $pageDb;
    
    protected $currentText;
    
    /**
     * WikiPage constructor.
     *
     * @param \Wiki\DbPageDirectory $pageDb
     */
    public function __construct(DbPageDirectory $pageDb)
    {
        $this->pageDb = $pageDb;
    }
    
    public function getText()
    {
        if (is_null($this->currentText)) {
            $currentTimestamp = $this->pageDb->getCurrentTimestamp();
            
            $currentPagePath = $this->pageDb->pagePath($currentTimestamp);
    
            $this->currentText = file_get_contents($currentPagePath);
        }
        
        return $this->currentText;
    }
    
    public function setUpdatedText($text)
    {
        $this->currentText = $text;
    }
    
    public function saveUpdatedText()
    {
        $this->pageDb->updateText($this->currentText);
    }
    
    public function getLatestVersion()
    {
        die('not implemented');
    }
}