<?php

namespace Framework\Factory;

use Cake\Core\ContainerInterface;
use Swift_Mailer;
use Swift_SmtpTransport;

class SwiftFactory
{
    public function __invoke(): Swift_Mailer
    {
        $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
            ->setUsername('kennymoulagang1@gmail.com')
            ->setPassword('tshibangu123');
        return new Swift_Mailer($transport);

    }
}