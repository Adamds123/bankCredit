<?php

namespace App\Authentification;

use App\Account\Actions\AttemptAction;
use App\Authentification\Actions\LoginAction;
use App\Authentification\Actions\LogoutAction;
use Framework\Modules;
use Framework\Renderer\Renderer;
use Framework\Router\Router;
use Psr\Container\ContainerInterface;

class AuthModule extends Modules
{
    //tableau des definitions de configuration

    public const DEFINITIONS = __DIR__ . '/config.php';

    //Configuration du dossier des migrations

    public const MIGRATIONS = __DIR__ . '/db/migrations';

    //Configuration du dossier des seeds

    public const SEEDS = __DIR__ . '/db/seeds';

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $renderer = $container->get(Renderer::class);
        $router = $container->get(Router::class);
        $renderer->addPath('auth', __DIR__ . '/views');
        $router->get($container->get('auth.login'), LoginAction::class, 'auth.login');
        $router->post($container->get('auth.login'), AttemptAction::class);
        $router->post($container->get('auth.logout'), LogoutAction::class, 'auth.logout');
    }
}