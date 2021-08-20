<?php

namespace App\Stead\Actions;

use App\Stead\Table\RoomsTable;
use Framework\Actions\RouterAware;
use Framework\Renderer\renderer;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;


class RoomAction
{
    private renderer $renderer;
    private RoomsTable $sallesTable;
    use RouterAware;

    public function __construct(
        Renderer   $renderer,
        RoomsTable $sallesTable,
    )
    {
        $this->renderer = $renderer;
        $this->sallesTable = $sallesTable;
    }

    public function __invoke(ServerRequest $request): string|ResponseInterface
    {
        $params = $request->getParsedBody();
        $salles = $this->sallesTable->findPublic();
        return $this->renderer->render('@app/rooms/index', compact('salles'));
    }

}