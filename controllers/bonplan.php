<?php

use Silex\ControllerCollection;

$bonplan = new ControllerCollection();
$bonplan->get('/categories', function() use ($app) {
    return $app['twig']->render('bonplan/categories.twig.html');
})->bind('categories');

$bonplan->get('/recherche', function() use ($app) {
    return $app['twig']->render('bonplan/recherche.twig.html');
})->bind('recherche');

return $bonplan;