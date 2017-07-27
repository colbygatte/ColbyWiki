<?php

namespace Wiki\Db;

/**
 * Each page is stored in a directory
 *
 * @package Wiki
 */
class DbPage
{
    // File names
    const FN_CURRENT = 'current';
    
    protected $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function path($append = '')
    {
        return $this->path.prepend_slash($append);
    }
    
    public function pagePath($timestamp)
    {
        return $this->path("page_$timestamp");
    }
    
    public function updateText($text, $time = null)
    {
        $time = $time ?: time();
        
        $resource = $this->makeResource($time);
        
        fwrite($resource, $text);
    
        $this->updateCurrentFile($time);
    }
    
    public function makeResource($time)
    {
        if (! file_exists($this->path())) {
            mkdir($this->path(), 0755);
        }
        
        return fopen($this->pagePath($time), 'w');
    }
    
    public function updateCurrentFile($time)
    {
        if (! file_exists($path = $this->path(static::FN_CURRENT))) {
            touch($path);
        }
        
        $fh = fopen($path, 'w');
        
        fwrite($fh, "$time");
    }
    
    /**
     * @return bool|string The most recently edited timestamp
     */
    public function getCurrentTimestamp()
    {
        if (! file_exists($path = $this->path(static::FN_CURRENT))) {
            return false;
        }
        
        return trim(fgets(fopen($path, 'r')));
    }
}