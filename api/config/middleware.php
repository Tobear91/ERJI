<?php

use App\Application\Middleware\ErrorHandlerMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(ErrorHandlerMiddleware::class);
    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(true, true, true);
};
