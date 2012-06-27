<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/views',
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider(), array());

$app->register(new Silex\Provider\FormServiceProvider());

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
      'locale' => 'en',
      'translator.messages' => array()
));

$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../data/db/bonplan.sqlite',
    ),
));

$app->get('/', function() use ($app){
    return $app['twig']->render('home.twig.html');
})->bind('home');

//$app->mount('/', include __DIR__.'/../src/controllers/bonplan.php');
$app->mount('/', new Bonplan\Controller\BonplanControllerProvider());

$app->run();
