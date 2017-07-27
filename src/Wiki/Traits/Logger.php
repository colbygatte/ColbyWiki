<?php

namespace Wiki\Traits;

use Wiki\DependencyContainer;

trait Logger
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        if (isset($this->logger)) {
            $this->logger->log($level, $message, $context);
        } elseif (isset($this->container) && $this->container instanceof DependencyContainer) {
            $this->container->log($level, $message, $context);
        } else {
            error_log($message);
        }
    }
}