<?php

namespace Bonplan\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

use Bonplan\Service\BonplanPersisterService;

class BonplanPersisterServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['bonplan.persister'] = $app->share(function () use ($app) {
            return new BonplanPersisterService($app['db']);
        });
    }

    public function boot(Application $app)
    {
    }
}
