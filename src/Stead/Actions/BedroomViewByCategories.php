<?php

namespace App\Stead\Actions;

use App\Stead\Table\BedroomsTable;
use App\Stead\Table\CategoriesTable;
use Framework\Actions\RouterAware;
use Framework\Renderer\Renderer;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;


final class BedroomViewByCategories
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
        $category = $this->categoriesTable->findBy('slug', $request->getAttribute('slug'));
        $rooms = $this->postTable->findPublicForCategory($category->id)->paginate(12,$params['page'] ?? 1);
        $categories = $this->categoriesTable->findAll();
        $page = $params['page'] ?? 1;
        return $this->renderer->render('@app/bedrooms/index', compact('rooms', 'categories', 'category','page'));
    }

}