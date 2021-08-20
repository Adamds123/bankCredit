<?php

namespace App\Stead\Actions;


use Framework\Renderer\Renderer;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;


class HomeAction
{
    private Renderer $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;

    }
    public function __invoke(ServerRequest $request): string|ResponseInterface
    {

        return $this->renderer->render('@app/index');
    }
}
