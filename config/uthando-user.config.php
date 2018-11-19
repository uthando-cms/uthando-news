<?php

use UthandoNews\Controller\FeedController;
use UthandoNews\Controller\NewsAdminController;
use UthandoNews\Controller\NewsController;
use UthandoNews\Controller\SettingsController;

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                FeedController::class => ['action' => ['feed']],
                                NewsController::class => ['action' => ['view', 'news-item']],
                            ],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                NewsAdminController::class => ['action' => 'all'],
                                SettingsController::class => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                FeedController::class,
                NewsController::class,
                NewsAdminController::class,
                SettingsController::class,
            ],
        ],
    ],
];
