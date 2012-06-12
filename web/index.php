<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider(), array()) ;

$app->get('/', function() use ($app){
    return $app['twig']->render('home.twig.html');
})->bind('home');

$app->run();
