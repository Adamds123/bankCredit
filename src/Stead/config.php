<?php

use function DI\add;
use function DI\get;

return[
    'rooms.prefix' => '/rooms',
    'admin.widgets' => add([
            get(\App\Admin\Actions\WidgetAction::class)
        ])
];