<?php

use App\Authentification\Actions\Authentification;
use Framework\Extensions\CsrfExtension;
use Framework\Extensions\Extensions;
use Framework\Extensions\FlashExtension;
use Framework\Extensions\FormExtension;
use Framework\Extensions\ModuleExtension;
use Framework\Extensions\PaginationExtension;
use Framework\Extensions\TimeExtension;
use Framework\Middleware\CsrfMiddleware;
use Framework\Renderer\Renderer;
use Framework\Renderer\RendererFactory;
use Framework\Router\Router;
use Framework\Session\Session;
use function DI\factory;
use function DI\get;
use function DI\object;

return [
    'viewPath' => dirname(__DIR__) . '/views',
    'extensions' => [
        get(Extensions::class),
        get(PaginationExtension::class),
        get(TimeExtension::class),
        get(FlashExtension::class),
        get(FormExtension::class),
        get(CsrfExtension::class)
    ],
    Session::class => object(),
    ModuleExtension::class => object()->constructorParameter('auth', get(Authentification::class)),
    CsrfMiddleware::class => object()->constructor(get(Session::class)),
    Router::class => object(),
    Renderer::class => factory(RendererFactory::class),
    PDO::class => function () {
        return new PDO('mysql:dbname=bank;host=127.0.0.1', 'root', '');
    },
    'mail.to' => 'musanziwilfried@gmail.com'
];