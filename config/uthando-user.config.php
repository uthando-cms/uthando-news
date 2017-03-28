<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoNews\Controller\Feed' => ['action' => ['feed']],
                                'UthandoNews\Controller\News' => ['action' => ['view', 'news-item']],
                            ],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoNews\Controller\NewsAdmin'  => ['action' => 'all'],
                                'UthandoNews\Controller\Settings'   => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                'UthandoNews\Controller\Feed',
                'UthandoNews\Controller\News',
                'UthandoNews\Controller\NewsAdmin',
                'UthandoNews\Controller\Settings',
            ],
        ],
    ],
];
