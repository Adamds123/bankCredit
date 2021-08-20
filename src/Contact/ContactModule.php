<?php
namespace App\Contact;

use App\Contact\Actions\ContactAction;
use Framework\Middleware\LoggedInMiddleware;
use Framework\Modules;
use Framework\Renderer\Renderer;
use Framework\Router\Router;
use Psr\Container\ContainerInterface;

class ContactModule extends  Modules
{
    public const DEFINITIONS = __DIR__.'/config.php';

    public function __construct(ContainerInterface $container)
    {
        $renderer = $container->get(renderer::class);
        $router = $container->get(router::class);
        $renderer->addPath('contact', __DIR__.'/views');
        $router->get($container->get('contact.prefix'),  ContactAction::class, 'contact');
        $router->post($container->get('contact.prefix'),ContactAction::class );
    }
}