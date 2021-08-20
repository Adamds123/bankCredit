<?php

namespace App\Stead\Actions;

use App\Stead\Table\BedroomsTable;
use App\Stead\Table\CategoriesTable;
use Framework\Actions\RouterAware;
use Framework\Renderer\Renderer;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;


final class BedroomsIndexAction
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
        $params = $request->getQueryParams();
        $rooms = $this->postTable->findPublic()->paginate(12, $params['page'] ?? 1);
        $categories = $this->categoriesTable->findAll();

        return $this->renderer->render('@app/bedrooms/index', compact('rooms', 'categories'));
    }

}