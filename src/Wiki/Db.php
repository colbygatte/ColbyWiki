<?php

namespace Wiki;

use Wiki\Db\DbPage;

class Db
{
    protected $directory;
    
    public function __construct($directory)
    {
        $this->directory = $directory;
    }
    
    /**
     * @param $page
     *
     * @return bool|\Wiki\Db\DbPage
     */
    public function getPageDirectory($page)
    {
        if (! is_wiki_name($page)) {
            return false; // TODO: Throw error?
        }
        
        return new DbPage($this->directory.prepend_slash($page));
    }
}