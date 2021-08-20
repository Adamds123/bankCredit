<?php

namespace App\Stead\Actions;

use App\Stead\Table\BedroomsTable;
use App\Stead\Table\CategoriesTable;
use Framework\Actions\RouterAware;
use Framework\Renderer\Renderer;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;


final class BedroomView
{
    private Renderer $renderer;
    private BedroomsTable $postTable;
    private CategoriesTable $categoriesTable;
    use RouterAware;

    public function __construct(
        Renderer        $renderer,
        BedroomsTable   $postTable,
        CategoriesTable $categoriesTable,
    )
    {
        $this->renderer = $renderer;
        $this->postTable = $postTable;
        $this->categoriesTable = $categoriesTable;
    }

    public function __invoke(ServerRequest $request): string|ResponseInterface
    {
        $slug = $request->getAttribute('slug');
        $room = $this->postTable->findWithCategory($request->getAttribute('id'));
        if ($room->name !== $slug) {
            return $this->redirect('rooms.view', [
                'slug' => $room->name,
                'id' => $room->id
            ]);
        }
        return $this->renderer->render('@app/bedrooms/view', compact('room'));
    }
}