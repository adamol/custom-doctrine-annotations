<?php

require_once __DIR__ . '/models.php';

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Annotations\AnnotationReader;
use Zend\Hydrator\Reflection;
use Symfony\Component\HttpFoundation\JsonResponse;

function parseRequest(Request $request, $class) {
	$annotationReader = new AnnotationReader;

    $refl = new \ReflectionClass(new $class);

    $args = [];

    foreach ($refl->getProperties() as $prop) {
	    $reflProp = new ReflectionProperty($class, $prop->getName());
	    $propAnnotations = $annotationReader->getPropertyAnnotations($reflProp)[0] ?? null;

        if ($propAnnotations instanceof FromRequest) {
            $args[$propAnnotations->value] = json_decode($request->getContent(), true)[$propAnnotations->value];
        }

        if ($propAnnotations instanceof FromQuery) {
            $args[$propAnnotations->value] = $request->query->get($propAnnotations->value);
        }
    }

    $instance = (new Reflection)->hydrate($args, new Post);

    return $instance;
}

function respondWithJson($instance) {
    return new JsonResponse((new Reflection)->extract($instance));
}
