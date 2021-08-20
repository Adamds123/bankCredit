<?php

use App\Admin\Actions\DashboardAction;
use App\Admin\adminModule;
use function DI\object;

return [
    'admin.prefix' => '/admin',
    'admin.widgets' => [],
    \App\Admin\Extension\AdminExtension::class => object()->constructorParameter('widgets', \DI\get('admin.widgets')),
    adminModule::class => object()->constructorParameter('prefix', \DI\get('admin.prefix')),
    DashboardAction::class => object()->constructorParameter('widgets', \DI\get('admin.widgets'))
];