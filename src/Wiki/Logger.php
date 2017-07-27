<?php

namespace Wiki;

use Psr\Log\LoggerInterface;
use Monolog\Logger as MonlogLogger;

class Logger extends MonlogLogger implements LoggerInterface
{
}