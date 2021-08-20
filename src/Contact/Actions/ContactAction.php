<?php

namespace App\Contact\Actions;

use Framework\Renderer\Renderer;
use Framework\Response\RedirectResponse;
use Framework\Session\FlashMessage;
use Framework\Validator;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swift_Mailer;
use Swift_Message;


class ContactAction
{
    private  $message = [
        'success' => 'Merci pour votre message nous vous contacterons le plus vite possible  !',
        'error' => 'Message suite aux erreurs rencontrées, Merci de les corriger !',
        'swifterror' => "Une erreur est survenue lors de l'envoie d'email"
    ];
    private $renderer;
    private FlashMessage $flashMessage;
    private  $container;
    private Swift_Mailer $mailer;

    public function __construct(ContainerInterface $container, Swift_Mailer $mailer
    )
    {
        $this->container = $container;
        $this->renderer = $container->get(Renderer::class);
        $this->flashMessage = $container->get(FlashMessage::class);
        $this->mailer = $mailer;
    }

    public function __invoke(ServerRequestInterface $request): string|RedirectResponse
    {

        if ($request->getMethod() === 'GET') {
            return $this->renderer->render('@contact/contact');
        }
        $validator = new Validator($request->getParsedBody());
        $validator->required('name', 'email', 'content')
            ->length('name', 4)
            ->email('email')
            ->length('content', 5, 20);
        if ($validator->isValid()){
          return $this->sendMail($request);
        }else{
            $errors = $validator->getErrors();
            $this->flashMessage->error($this->message['error']);
            return  $this->renderer->render('@contact/contact', compact('errors'));
        }
    }
    private function sendMail(ServerRequestInterface $request): RedirectResponse
    {
        $params = $request->getParsedBody();
        try {
            $message = (new Swift_Message('Formulaire de contact'))
                ->setFrom($params['email'])
                ->setTo(['kennymoulagang1@gmail.com'=>'kenny'])
                ->setBody($this->renderer->render('@contact/email/message', $params))
                ->addPart($this->renderer->render('@contact/email/message', $params), 'text/html');
                $this->mailer->send($message);
                $this->flashMessage->success($this->message['success']);
        }catch (\Exception $e){
            $this->flashMessage->error($this->message['swifterror']);
        }
        return new redirectResponse((string)$request->getUri());
    }
}