<?php

return [
    'navigation' => [
        'admin' => [
            'admin' => [
                'pages' => [
                    'settings' => [
                        'pages' => [
                            'news-settings' => [
                                'label' => 'News',
                                'action' => 'index',
                                'route' => 'admin/news/settings',
                                'resource' => 'menu:admin',
                            ],
                        ],
                    ],
                ],
            ],
            'news' => [
                'label' => 'News',
                'pages' => [
                    'list' => [
                        'label'     => 'List All News Items',
                        'action'    => 'index',
                        'route'     => 'admin/news',
                        'resource'  => 'menu:admin'
                    ],
                    'add' => [
                        'label'     => 'Add New News Item',
                        'action'    => 'add',
                        'route'     => 'admin/news/edit',
                        'resource'  => 'menu:admin'
                    ],
                    'news-settings' => [
                        'label' => 'Settings',
                        'action' => 'index',
                        'route' => 'admin/news/settings',
                        'resource' => 'menu:admin',
                    ],
                ],
                'route'     => 'admin/news',
                'resource'  => 'menu:admin'
            ],
        ],
    ],
];
