<?php

return [
    'controllers' => [
        'invokables' => [
            'UthandoNews\Controller\News'       => 'UthandoNews\Controller\News',
            'UthandoNews\Controller\Settings'   => 'UthandoNews\Controller\Settings',
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'UthandoNews'                   => 'UthandoNews\Form\News',
            'UthandoNewsFeedFieldSet'       => 'UthandoNews\Form\NewsFeedFieldSet',
            'UthandoNewsOptionsFieldSet'    => 'UthandoNews\Form\NewsOptionsFieldSet',
            'UthandoNewsSettings'           => 'UthandoNews\Form\NewsSettings',
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
    'service_manager' => [
        'factories' => [
            'UthandoNewsFeedOptions'    => 'UthandoNews\Service\NewsFeedOptionsFactory',
            'UthandoNewsOptions'        => 'UthandoNews\Service\NewsOptionsFactory',
        ]
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
        'strategies' => [
            'ViewFeedStrategy',
        ],
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
                    ],
                ],
            ],
            'news-feed' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/news/feed',
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoNews\Controller',
                        'controller'    => 'News',
                        'action'        => 'feed',
                    ],
                ],
            ],
        ],
    ],
];