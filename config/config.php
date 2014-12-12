<?php

return [
    'router' => [
        'routes' => [
            'news-list' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/news',
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoNews\Controller',
                        'controller'    => 'News',
                        'action'        => 'view',
                        'force-ssl'     => 'http'
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'page' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'         => '/page/[:page]',
                            'constraints'   => [
                                'page' => '\d+'
                            ],
                            'defaults'      => [
                                'action'        => 'view',
                                'page'          => 1,
                                'force-ssl'     => 'ssl'
                            ],
                        ],
                    ],
                ],
            ],
            'news' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/news/view[:news-item]',
                    'constraints' => [
                        'news-item'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoNews\Controller',
                        'controller'    => 'News',
                        'action'        => 'view-news',
                        'force-ssl'     => 'http'
                    ],
                ],
            ],
            'admin' => [
                'news' => [
                    'child_routes' => [
                        'news' => [
                            'type' => 'Literal',
                            'options' => [
                                'route' => '/news',
                                'constraints'   => [
                                    'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ],
                                'defaults' => [
                                    '__NAMESPACE__' => 'UthandoNews\Controller',
                                    'controller'    => 'News',
                                    'action'        => 'index',
                                    'force-ssl'     => 'ssl'
                                ],
                            ],
                            'may_terminate' => true,
                            'child_routes' => [
                                'edit' => [
                                    'type'    => 'Segment',
                                    'options' => [
                                        'route'         => '/[:action[/id/[:id]]]',
                                        'constraints'   => [
                                            'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            'id'		=> '\d+'
                                        ],
                                        'defaults'      => [
                                            'action'        => 'edit',
                                            'force-ssl'     => 'ssl'
                                        ],
                                    ],
                                ],
                                'page' => [
                                    'type'    => 'Segment',
                                    'options' => [
                                        'route'         => '/page/[:page]',
                                        'constraints'   => [
                                            'page' => '\d+'
                                        ],
                                        'defaults'      => [
                                            'action'        => 'list',
                                            'page'          => 1,
                                            'force-ssl'     => 'ssl'
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_map' => include __DIR__ . '/../template_map.php'
    ],
];