<?php


namespace App\Authentification\Actions;

use Framework\Renderer\Renderer;
use Framework\Session\FlashMessage;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class LogoutAction
{
    private Renderer $renderer;
    private Authentification $auth;
    private FlashMessage $flashMessage;
    private $messages = [
        'deconnect' => 'Vous venez de vous déconnecter'
    ];

    public function __construct(Renderer $renderer, Authentification $auth, FlashMessage $flashMessage)
    {
        $this->renderer = $renderer;
        $this->auth = $auth;
        $this->flashMessage = $flashMessage;
    }

    public function __invoke(ServerRequest $request): string|Response
    {
        $this->auth->logout();
        $this->flashMessage->success($this->messages['deconnect']);
        return $this->renderer->render('@auth/login');
    }
}