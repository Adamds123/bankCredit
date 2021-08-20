<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$whoops = (new \Whoops\Run())->pushHandler(new \Whoops\Handler\PrettyPageHandler())->register();
$app = (new \Framework\App(dirname(__DIR__) . '/config/config.php'))

    ->addModule(\App\Admin\AdminModule::class)
    ->addModule(\App\Contact\ContactModule::class)
    ->addModule(\App\Account\AccountModule::class)
    ->addModule(\App\Authentification\AuthModule::class);

$container = $app->getContainer();

$app->make(\Middlewares\Whoops::class)
    ->make(\Framework\Middleware\TrailingSlashMiddleware::class)
    ->make(\Framework\Middleware\RouterMiddleware::class)
    ->make(\Framework\Middleware\ForbiddenMiddleware::class)
    ->make(\Framework\Middleware\RoleMiddleware::class, $container->get('admin.prefix'))
    ->make(\Framework\Middleware\MethodMiddleware::class)
    ->make(\Framework\Middleware\DispatcherMiddleware::class)
    ->make(\Framework\Middleware\CsrfMiddleware::class)
    ->make(\Framework\Middleware\NotFoundMiddleware::class);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);

