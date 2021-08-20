<?php

namespace App\Account\Actions;

use App\Account\Entity\UserEntity;
use App\Account\Table\UserTable;
use App\Authentification\Actions\Authentification;
use Framework\Actions\RouterAware;
use Framework\Database\Hydrator;
use Framework\Renderer\Renderer;
use Framework\Response\RedirectResponse;
use Framework\Router\Router;
use Framework\Session\FlashMessage;
use Framework\Validator;
use GuzzleHttp\Psr7\ServerRequest;

class SignupAction
{
    private Renderer $renderer;
    private UserTable $userTable;
    private FlashMessage $flashMessage;
    private Router $router;
    private Authentification $auth;
    use RouterAware;

    public function __construct(renderer         $renderer,
                                UserTable        $userTable,
                                Router          $router,
                                Authentification $auth,
                                FlashMessage     $flashMessage
    )
    {
        $this->renderer = $renderer;
        $this->userTable = $userTable;
        $this->flashMessage = $flashMessage;
        $this->router = $router;
        $this->auth = $auth;
    }
    public function __invoke(ServerRequest $request): string|\Psr\Http\Message\ResponseInterface
    {
        $params = $request->getParsedBody();
        $validator = new Validator($params);
        if ($request->getMethod() === 'GET') {
            return $this->renderer->render('@account/signup');
        }
        $validator->required('username', 'email', 'password', 'password_confirm')
            ->length('username', 5)
            ->email('email')
            ->confirm('password')
            ->length('password', 4)
            ->unique('username', $this->userTable)
            ->unique('email', $this->userTable);
        if ($validator->isValid()) {
            $userParams = [
                'firstname' => $params['firstname'],
                'lastName' => $params['lastName'],
                'username' => $params['username'],
                'email' => $params['email'],
                'password' => password_hash($params['password'], PASSWORD_DEFAULT)
            ];
            $this->userTable->insert($userParams);
            $user = Hydrator::hydrate($userParams, UserEntity::class);
            $user->id = $this->userTable->getPdo()->lastInsertId();
            $this->auth->setUser($user);
            $this->flashMessage->success("Votre compte a bien été crée");
            return $this->redirect('account');
        }
        $errors = $validator->getErrors();
        return $this->renderer->render('@account/signup', [
            'errors' => $errors,
            'user' => [
                'username' => $params['username'],
                'email' => $params['email']
            ]
        ]);
    }
}