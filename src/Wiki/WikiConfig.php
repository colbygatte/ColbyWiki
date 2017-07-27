<?php

namespace Wiki;

use ColbyGatte\Utilities\DynamicCalls\Config as DynamicCallsConfig;
use ColbyGatte\Utilities\Traits\DynamicCalls;

/**
 * Class Config
 *
 * @package Wiki
 * @method string getDatabaseDirectory()
 * @method setDatabaseDirectory(string $databaseDirectory)
 */
class WikiConfig
{
    use DynamicCalls;
    
    protected $databaseDirectory = __DIR__.'/db';
    
    public function setupDynamicCalls(DynamicCallsConfig $config)
    {
        $config->allowSetterAndGetter([
            'databaseDirectory'
        ]);
    }
}