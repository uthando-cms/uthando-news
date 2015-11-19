<?php

return [
    'router' => [
        'routes' => [
            'admin' => [
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
                                'may_terminate' => true,
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
                                'may_terminate' => true,
                            ],
                            'settings' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/settings',
                                    'defaults' => [
                                        'controller' => 'Settings',
                                        'action' => 'index',
                                        'force-ssl' => 'ssl'
                                    ]
                                ],
                                'may_terminate' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];