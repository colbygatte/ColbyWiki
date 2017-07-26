<?php

namespace Wiki;

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
     * @return bool|\Wiki\DbPageDirectory
     */
    public function getPageDirectory($page)
    {
        if (! is_wiki_name($page)) {
            return false; // TODO: Throw error?
        }
        
        return new DbPageDirectory($this->directory.prepend_slash($page));
    }
}