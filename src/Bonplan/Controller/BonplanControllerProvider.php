<?php

namespace Bonplan\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

use Symfony\Component\HttpFoundation\Request;

use Bonplan\Entity\Bonplan;
use Bonplan\Form\Type\BonplanType;

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
            $form = $app['form.factory']->create(new BonplanType(), new Bonplan());

            return $app['twig']->render('bonplan/ajouter.twig.html', array('form' => $form->createView()));
        })->bind('ajouter');

        $controllers->post('/ajouter', function(Request $request) use ($app) {
            $form = $app['form.factory']->create(new BonplanType(), new Bonplan());
            $form->bindRequest($request);
            if ($form->isValid()) {
                $bonplan = $form->getData();
                // do something with the data
                // redirect somewhere
                //return $app->redirect('...');
            }

            return $app['twig']->render('bonplan/ajouter.twig.html', array('form' => $form->createView()));
        })->bind('post_ajouter');

        $controllers->get('/detail', function() use ($app) {
          return $app['twig']->render('bonplan/detail.twig.html');
        })->bind('detail');

        return $controllers;
    }
}