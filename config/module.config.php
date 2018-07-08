<?php

return [
    'controllers' => [
        'invokables' => [
            \UthandoNews\Controller\FeedController::class       => \UthandoNews\Controller\FeedController::class,
            \UthandoNews\Controller\NewsController::class       => \UthandoNews\Controller\NewsController::class,
            \UthandoNews\Controller\NewsAdminController::class  => \UthandoNews\Controller\NewsAdminController::class,
            \UthandoNews\Controller\SettingsController::class   => \UthandoNews\Controller\SettingsController::class,
        ],
    ],
    'form_elements' => [
        'invokables' => [
            \UthandoNews\Form\NewsForm::class               => \UthandoNews\Form\NewsForm::class,
            \UthandoNews\Form\NewsFeedFieldSet::class      => \UthandoNews\Form\NewsFeedFieldSet::class,
            \UthandoNews\Form\NewsOptionsFieldSet::class   => \UthandoNews\Form\NewsOptionsFieldSet::class,
            \UthandoNews\Form\NewsSettingsForm::class      => \UthandoNews\Form\NewsSettingsForm::class,
        ],
    ],
    'hydrators' => [
        'invokables' => [
            \UthandoNews\Hydrator\NewsHydrator::class => \UthandoNews\Hydrator\NewsHydrator::class,
        ],
    ],
    'input_filters' => [
        'invokables' => [
            \UthandoNews\InputFilter\NewsInputFilter::class => \UthandoNews\InputFilter\NewsInputFilter::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            \UthandoNews\Options\FeedOptions::class    => \UthandoNews\Service\NewsFeedOptionsFactory::class,
            \UthandoNews\Options\NewsOptions::class    => \UthandoNews\Service\NewsOptionsFactory::class,
        ]
    ],
    'uthando_mappers' => [
        'invokables' => [
            \UthandoNews\Mapper\NewsMapper::class => \UthandoNews\Mapper\NewsMapper::class,
        ],
    ],
    'uthando_models' => [
        'invokables' => [
            \UthandoNews\Model\NewsModel::class => \UthandoNews\Model\NewsModel::class,
        ]
    ],
    'uthando_services' => [
        'invokables' => [
            \UthandoNews\Service\News::class => \UthandoNews\Service\News::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'NewsHelper' => \UthandoNews\View\NewsHelper::class
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
                        'controller'    => \UthandoNews\Controller\NewsController::class,
                        'action'        => 'view',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'search' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'         => '/search/[:search][/[:page]]',
                            'constraints'   => [
                                'search'   => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+',
                            ],
                            'defaults'      => [
                                'action'        => 'view',
                                'search'        => '',
                                'page'          => 1,
                            ],
                        ],
                    ],
                    'tag' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'         => '/tag/[:tag][/[:page]]',
                            'constraints'   => [
                                'tag'   => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+',
                            ],
                            'defaults'      => [
                                'action'        => 'view',
                                'tag'           => '',
                                'page'          => 1,
                            ],
                        ],
                    ],
                    'archives' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'         => '/[:year]/[:month][/[:page]]',
                            'constraints'   => [
                                'year' => '\d+',
                                'month' => '\d+',
                                'page' => '\d+',
                            ],
                            'defaults'      => [
                                'action'     => 'view',
                                'page'       => 1,
                            ],
                        ],
                    ],
                    'page' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'         => '/[:page]',
                            'constraints'   => [
                                'page' => '\d+',
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
                        'controller'    => \UthandoNews\Controller\NewsController::class,
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
                        'controller'    => \UthandoNews\Controller\FeedController::class,
                        'action'        => 'feed',
                    ],
                ],
            ],
        ],
    ],
];