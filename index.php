<?php

require __DIR__.'/vendor/autoload.php';

require __DIR__.'/models.php';
require __DIR__.'/parseRequest.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application;

$app['debug'] = true;

    $instance = parseRequest($request, Post::class);
$app->post('posts', function(Request $request) {

    // do things with the parsed arguments

    return respondWithJson($instance);
});

$app->run();

