<?php

namespace App\Account\Actions;

use Framework\Actions\RouterAware;
use Framework\Renderer\Renderer;
use Framework\Router\Router;
use Framework\Session\FlashMessage;
use Framework\Session\Session;
use GuzzleHttp\Psr7\ServerRequest;

class AttemptAction
{
    private $messages = [
        'success' => "Vous etes connecté",
        'error' => "Identifiant ou mot de passe incorrect"
    ];
    private $renderer;

    private $auth;

    private $session;

    private $router;
    private $flashMessage;

    use RouterAware;

    public function __construct(
        Renderer                                       $renderer,
        \App\Authentification\Actions\Authentification $auth,
        Router                                         $router,
        Session                                        $session, FlashMessage $flashMessage
    )
    {

        $this->renderer = $renderer;
        $this->auth = $auth;
        $this->router = $router;
        $this->session = $session;
        $this->flashMessage = $flashMessage;
    }

    public function __invoke(ServerRequest $request): \Psr\Http\Message\ResponseInterface
    {
        $params = $request->getParsedBody();
        $user = $this->auth->login($params['username'], $params['password']);
        if ($user) {
            $this->flashMessage->success($this->messages['success']);
            if ($user->roles == 'admin') {
                return $this->redirect('dashboard');
            } else {
                $this->session->delete('auth.redirect');
                return $this->redirect('account');
            }
        } else {
            $this->flashMessage->error($this->messages['error']);
            return $this->redirect('auth.login');
        }
    }
}