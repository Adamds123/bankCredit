<?php

namespace App\Account\Actions;

use App\Account\Table\UserTable;
use App\Authentification\Actions\Authentification;
use Framework\Renderer\Renderer;
use Framework\Response\RedirectResponse;
use Framework\Session\FlashMessage;
use Framework\Validator;
use GuzzleHttp\Psr7\ServerRequest;

class AccountEditAction
{
    private UserTable $userTable;
    private FlashMessage $flashMessage;
    private Authentification $auth;
    private Renderer $renderer;

    public function __construct(Renderer $renderer, Authentification $auth, UserTable $userTable, FlashMessage $flashMessage)
    {
        $this->userTable = $userTable;
        $this->flashMessage = $flashMessage;
        $this->auth = $auth;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequest $request): string|RedirectResponse
    {
        $user = $this->auth->getUser();
        $params = $request->getParsedBody();
        $validator = (new Validator($params))
            ->required('firstname', 'lastName')
        ->confirm('password');
        if ($validator->isValid()) {
            $userParams =[
                'firstname' => $params['firstname'],
                'username' => $params['username'],
                'lastName' => $params['lastName'],
            ];
            if (!empty($params['password'])) {
                    $userParams['password']= password_hash($params['password'], PASSWORD_DEFAULT);
            }
            $this->userTable->update($user->id, $userParams );
            $this->flashMessage->success('Votre compte a bien été mis à jour !');
            return new RedirectResponse($request->getUri()->getPath());
        }
        $errors = $validator->getErrors();
        return $this->renderer->render('@account/profile', compact('user', 'errors'));
    }
}