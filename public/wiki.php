<?php

namespace Wiki;

use Wiki\Parser\ParsedPageFactory;
use Wiki\Responses\ResponseFactory;

define('WIKI_PUB_ROOT', 'http://localhost/colbywiki/public');

Container::setInstance(
    new Container(
        new Wiki(new Db(__DIR__.'/../tests/db')),
        new Request($_POST, $_GET),
        new TemplateEngine(__DIR__.'/../resources/views'),
        new Responder,
        new ResponseFactory,
        new Parser(new ParsedPageFactory),
        new WikiTextTokenStyler,
        new Controller,
        new Logger('WikiLogger')
    )
);

app()->run();