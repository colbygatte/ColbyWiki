<?php

namespace Wiki;

use Wiki\Parser\ParsedPageFactory;
use Wiki\Responses\ResponseFactory;

(new DependencyContainer(
    new Wiki(new Db(__DIR__.'/../tests/db')),
    new Request($_POST, $_GET),
    new Renderer(__DIR__.'/../resources/views'),
    new Responder,
    new ResponseFactory,
    new Parser(new ParsedPageFactory),
    new WikiTextTokenStyler,
    new Controller,
    new Logger('WikiLogger')
))->run();