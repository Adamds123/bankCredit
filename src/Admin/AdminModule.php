<?php

namespace App\Admin;

use App\Admin\Actions\BedroomsCrud;
use App\Admin\Actions\CategoriesCrud;
use App\Admin\Actions\DashboardAction;
use App\Admin\Actions\EatyCrud;
use App\Admin\Actions\ReservationAction;
use App\Admin\Actions\RoomsCrud;
use App\Admin\Actions\UserCrud;
use App\Admin\Extension\AdminExtension;
use Framework\Modules;
use Framework\Renderer\Renderer;
use Framework\Router\Router;
use Psr\Container\ContainerInterface;

class AdminModule extends Modules
{

    public const DEFINITIONS = __DIR__ . '/config.php';
    public const MIGRATIONS = __DIR__.'/db/migrations';
    public const SEEDS = __DIR__.'/db/seeds';

    public function __construct(ContainerInterface $container)
    {
        $router = $container->get(Router::class);
        $renderer = $container->get(Renderer::class);
        $prefix = $container->get('admin.prefix');
        $renderer->addPath('admin', __DIR__ . '/views');

    }
}