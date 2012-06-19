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

$bonplan_controller->get('/ajouter', function() use ($app) {
	$bonplan = new Bonplan();
	$form = $app['form.factory']
		->createBuilder(new BonplanType)
        ->add('date', 'text')
        ->add('lieu', 'text')
        ->add('description', 'text')
        ->getForm();

	return $app['twig']->render('bonplan/ajouter.twig.html', array('form' => $form->createView()));
})->bind('ajouter');

$bonplan_controller->get('/detail', function() use ($app) {
	return $app['twig']->render('bonplan/detail.twig.html');
})->bind('detail');

return $bonplan_controller;