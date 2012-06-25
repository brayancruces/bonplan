<?php

namespace Bonplan\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class BonplanControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/categories', function() use ($app) {
            return $app['twig']->render('bonplan/categories.twig.html');
        })->bind('categories');

        $controllers->get('/recherche', function() use ($app) {
            return $app['twig']->render('bonplan/recherche.twig.html');
        })->bind('recherche');

        $controllers->get('/plandujour', function() use ($app) {
            return $app['twig']->render('bonplan/plandujour.twig.html');
        })->bind('plandujour');

        $controllers->get('/favoris', function() use ($app) {
            return $app['twig']->render('bonplan/favoris.twig.html');
        })->bind('favoris');

        $controllers->get('/ajouter', function() use ($app) {
          $bonplan = new Bonplan();
          $form = $app['form.factory']
            ->createBuilder(new BonplanType)
                ->add('date', 'text')
                ->add('lieu', 'text')
                ->add('description', 'text')
                ->getForm();

          return $app['twig']->render('bonplan/ajouter.twig.html', array('form' => $form->createView()));
        })->bind('ajouter');

        $controllers->get('/detail', function() use ($app) {
          return $app['twig']->render('bonplan/detail.twig.html');
        })->bind('detail');

        return $controllers;
    }
}