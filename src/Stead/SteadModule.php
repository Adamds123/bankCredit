<?php

namespace App\Stead;

use App\Stead\Actions\BedroomsIndexAction;
use App\Stead\Actions\BedroomView;
use App\Stead\Actions\BedroomViewByCategories;
use App\Stead\Actions\EatyAction;
use App\Stead\Actions\HomeAction;
use App\Stead\Actions\RoomAction;
use Framework\Modules;
use Framework\Renderer\Renderer;
use Framework\Router\Router;
use Psr\Container\ContainerInterface;

class SteadModule extends Modules
{
    /**
     *tableau des definitions de configuration
     */
    public const DEFINITIONS = __DIR__ . '/config.php';
    /**
     *Configuration du dossier des migrations
     */
    public const MIGRATIONS = __DIR__ . '/db/migrations';
    /**
     *Configuration du dossier des seeds
     */
    public const SEEDS = __DIR__ . '/db/seeds';


    public function __construct(ContainerInterface $container)
    {
        $container->get(Renderer::class)->addPath('app', __DIR__ . '/views');
        $router = $container->get(Router::class);
        $roomPrefix = $container->get('rooms.prefix');
        $router->get('/', BedroomsIndexAction::class, 'rooms.index');
        $router->get('/salles', RoomAction::class, 'salles.index');
        $router->get('/restau', EatyAction::class, 'restau.index');
        $router->get($roomPrefix. '/{slug:[a-z0-9\-]+}-{id:[\d]+}', BedroomView::class, 'rooms.view');
        $router->get($roomPrefix . '/categories/{slug:[a-z0-9\-]+}', BedroomViewByCategories::class, 'rooms.category');
    }

}