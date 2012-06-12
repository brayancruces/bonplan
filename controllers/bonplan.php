<?php

use Silex\ControllerCollection;

$bonplan = new ControllerCollection();
$bonplan->get('/categories', function() use ($app) {
    return $app['twig']->render('bonplan/categories.twig.html');
})->bind('categories');

return $bonplan;