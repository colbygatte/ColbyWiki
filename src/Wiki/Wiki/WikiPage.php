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
     * WikiPage constructor.
     *
     * @param \Wiki\Db\DbPage $pageDb
     */
    public function __construct(DbPage $pageDb)
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
}