<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                \UthandoNews\Controller\FeedController::class => ['action' => ['feed']],
                                \UthandoNews\Controller\NewsController::class => ['action' => ['view', 'news-item']],
                            ],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                \UthandoNews\Controller\NewsAdminController::class => ['action' => 'all'],
                                \UthandoNews\Controller\SettingsController::class => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                \UthandoNews\Controller\FeedController::class,
                \UthandoNews\Controller\NewsController::class,
                \UthandoNews\Controller\NewsAdminController::class,
                \UthandoNews\Controller\SettingsController::class,
            ],
        ],
    ],
];
