<?php

return [
    'controllers' => [
        'invokables' => [
            'UthandoNews\Controller\News' => 'UthandoNews\Controller\News',
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'UthandoNews'           => 'UthandoNews\Form\News',
            'UthandoNewsFieldSet'   => 'UthandoNews\Form\NewsFieldSet',
        ],
    ],
    'hydrators' => [
        'invokables' => [
            'UthandoNews' => 'UthandoNews\Hydrator\News',
        ],
    ],
    'input_filters' => [
        'invokables' => [
            'UthandoNews' => 'UthandoNews\InputFilter\News',
        ],
    ],
    'uthando_mappers' => [
        'invokables' => [
            'UthandoNews' => 'UthandoNews\Mapper\News',
        ],
    ],
    'uthando_models' => [
        'invokables' => [
            'UthandoNews' => 'UthandoNews\Model\News',
        ]
    ],
    'uthando_services' => [
        'invokables' => [
            'UthandoNews' => 'UthandoNews\Service\News',
        ],
    ],
    'view_manager' => [
        'template_map' => include __DIR__ . '/../template_map.php'
    ],
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
                    'route' => '/news/[:news-item]',
                    'constraints' => [
                        'news-item'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoNews\Controller',
                        'controller'    => 'News',
                        'action'        => 'news-item',
                        'force-ssl'     => 'http'
                    ],
                ],
            ],
        ],
    ],
];