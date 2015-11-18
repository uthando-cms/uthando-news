<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoNews\Controller\News' => ['action' => ['view', 'news-item', 'feed']],
                            ],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoNews\Controller\News' => ['action' => 'all'],
                                'UthandoNews\Controller\Settings' => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                'UthandoNews\Controller\News',
                'UthandoNews\Controller\Settings',
            ],
        ],
    ],
];
