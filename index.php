<?php

require __DIR__.'/vendor/autoload.php';

require __DIR__.'/models.php';
require __DIR__.'/parseRequest.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application;

$app['debug'] = true;

$app->post('posts', function(Request $request) {
    $instance = parseRequest($request, Post::class);

    // do things with the parsed arguments

    return respondWithJson($instance);
});

$app->run();

