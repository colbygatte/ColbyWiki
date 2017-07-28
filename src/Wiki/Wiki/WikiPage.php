<?php

namespace Wiki\Wiki;

use Wiki\Db\DbPage;

/**
 * All information about a WikiPage should be accessed through this class.
 *
 * @package Wiki\Wiki
 */
class WikiPage
{
    /**
     * @var \Wiki\Db\DbPage
     */
    protected $pageDb;
    
    /**
     * This is the most recent wiki text for the current page
     *
     * @var string
     */
    protected $currentText;
    
    /**
     * @var string
     */
    protected $pageName;
    
    /**
     * WikiPage constructor.
     *
     * @param \Wiki\Db\DbPage $pageDb
     */
    public function __construct(DbPage $pageDb, $pageName)
    {
        
        $this->pageDb = $pageDb;
        $this->pageName = $pageName;
    }
    
    public function getPageName()
    {
        return $this->pageName;
    }
    
    /**
     * @return bool|string
     */
    public function exists()
    {
        if ($currentTimestamp = $this->pageDb->getCurrentTimestamp()) {
            return $currentTimestamp;
        }
        
        return false;
    }
    
    public function getText()
    {
        if (is_null($this->currentText)) {
            if (! $currentTimestamp = $this->exists()) {
                return false;
            }
            
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
}