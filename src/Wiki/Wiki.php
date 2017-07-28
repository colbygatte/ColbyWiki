<?php

namespace Wiki;

use Wiki\Wiki\WikiPage;

class Wiki
{
    protected $config;
    
    /**
     * @var \Wiki\Db
     */
    protected $db;
    
    /**
     * @var \Wiki\Parser
     */
    protected $parser;
    
    public function __construct(Db $db)
    {
        $this->db = $db;
    }
    
    /**
     * Pages should ONLY be loaded through this function.
     *
     * @param $page
     *
     * @return \Wiki\Wiki\WikiPage
     */
    public function getPage($page)
    {
        $pageName = wiki_name($page);
        
        return new WikiPage(
            $this->db->getPageDirectory($pageName),
            $pageName
        );
    }
    
    /**
     * @param string $page Wiki Page name. Will be ran through @see wiki_name()
     *
     * @return bool
     */
    public function pageExists($page)
    {
        return file_exists($this->db->getPageDirectory(wiki_name($page))->path());
    }
}

