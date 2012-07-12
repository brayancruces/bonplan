<?php

require_once __DIR__.'/../vendor/autoload.php';

$env = getenv('APP_ENV') ?: 'prod';

$app = new Silex\Application();

$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__."/../config/$env.yml"));

$app['debug'] = isset($app['config.global']) ?: false;

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

$app->register(new Silex\Provider\DoctrineServiceProvider(), array('db.options' => $app['config.database']));

$app->get('/', function() use ($app){
    return $app['twig']->render('home.twig.html');
})->bind('home');

$app->mount('/', new Bonplan\Controller\BonplanControllerProvider());

$app->run();
