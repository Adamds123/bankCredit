<?php

namespace App\Stead\Actions;

use App\Stead\Table\EatyTable;
use Framework\Actions\RouterAware;
use Framework\Renderer\Renderer;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;


class EatyAction
{
    private Renderer $renderer;
    private EatyTable $restaurantTable;
    use RouterAware;

    public function __construct(
        Renderer  $renderer,
        EatyTable $restaurantTable
    )
    {
        $this->renderer = $renderer;
        $this->restaurantTable = $restaurantTable;
    }

    public function __invoke(ServerRequest $request): string|ResponseInterface
    {
        $plats = $this->restaurantTable->findPublic();
        return $this->renderer->render('@app/eaty/index', compact('plats'));
    }

}
