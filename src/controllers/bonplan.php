<?php

use Silex\ControllerCollection;

$bonplan_controller = $app['controllers_factory'];

$bonplan_controller->get('/categories', function() use ($app) {
    return $app['twig']->render('bonplan/categories.twig.html');
})->bind('categories');

$bonplan_controller->get('/recherche', function() use ($app) {
    return $app['twig']->render('bonplan/recherche.twig.html');
})->bind('recherche');

$bonplan_controller->get('/plandujour', function() use ($app) {
    return $app['twig']->render('bonplan/plandujour.twig.html');
})->bind('plandujour');

$bonplan_controller->get('/favoris', function() use ($app) {
    return $app['twig']->render('bonplan/favoris.twig.html');
})->bind('favoris');

$bonplan->get('/ajouter', function() use ($app) {
	return $app['twig']->render('bonplan/ajouter.twig.html');
})->bind('ajouter');

$bonplan_controller->get('/detail', function() use ($app) {
	return $app['twig']->render('bonplan/detail.twig.html');
})->bind('detail');

return $bonplan_controller;