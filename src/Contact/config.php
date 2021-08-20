<?php

use App\Contact\Actions\contactAction;
use function DI\get;
use function DI\object;

return[
    'contact.prefix' => '/contact',
    'password' => 'will20022606',
    'contact.to' => get('mail.to'),
    Swift_Mailer:: class => \DI\factory(\Framework\Factory\SwiftFactory::class)
];