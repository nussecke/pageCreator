<?php
return array(
    # ------------------------------- CONTROLLERS ------------------------------- #
    'controllers' => array(
        'invokables' => array(
            'PageCreator\Controller\PageCreator' => 'PageCreator\Controller\PageCreatorController',
        ),
    ),
    # ------------------------------- ROUTER ------------------------------- #
    'router' => array(
        # ROUTE     pageCreator
        'routes' => array(
            'pagecreator' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/pagecreator',
                    'constraints' => array(),
                    'defaults' => array(
                        'controller' => 'PageCreator\Controller\PageCreator',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'pagecreatoraction' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:action',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action' => 'index'
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pagecratorpage' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/page/:page',
                                    'constraints' => array(
                                        'page' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'page' => 1
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'pagecratororderby' => array(
                                        'type' => 'segment',
                                        'options' => array(
                                            'route' => '/orderby/:orderby',
                                            'constraints' => array(
                                                'orderby' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                            'pagecratororder' => array(
                                                'type' => 'segment',
                                                'options' => array(
                                                    'route' => '/order/:order',
                                                    'constraints' => array(
                                                        'order' => 'ASC|DESC',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                                'child_routes' => array(
                                                    'pagecratorresults' => array(
                                                        'type' => 'segment',
                                                        'options' => array(
                                                            'route' => '/results/:results',
                                                            'constraints' => array(
                                                                'results' => '[0-9]+'
                                                            ),
                                                            'defaults' => array()
                                                        ),
                                                        'may_terminate' => true,
                                                        'child_routes' => array(
                                                            'pagecratorsearch' => array(
                                                                'type' => 'segment',
                                                                'options' => array(
                                                                    'route' => '/search/:search',
                                                                    'constraints' => array(
                                                                        'order' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                    ),
                                                                ),
                                                                'may_terminate' => true,
                                                                'child_routes' => array(
                                                                    'pagecratorsearchsubmitted' => array(
                                                                        'type' => 'segment',
                                                                        'options' => array(
                                                                            'route' => '/submitted/:status',
                                                                            'constraints' => array(
                                                                                'status' => '(true|false)'
                                                                            ),
                                                                            'defaults' => array(
                                                                                'status' => 'false'
                                                                            )
                                                                        ),
                                                                        'may_terminate' => true,
                                                                    )
                                                                )
                                                            )
                                                        )
                                                    ),
                                                )
                                            )
                                        )
                                    )
                                )
                            ),
                        )
                    ),
                    'pagecratorpagecratorid' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:basketheaderid',
                            'constraints' => array(
                                'pagecratorid' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pagecratoraction' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/:action',
                                    'constraints' => array(
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'index'
                                    ),
                                ),
                            ),
                        )
                    )
                )
            ),
        ),
    ),
    # ------------------------------- TRANSLATOR ------------------------------- #
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
                'text_domain' => 'PageCreator',
            )
        ),
    ),
    # ------------------------------- VIEW MANAGER ------------------------------- #
    'view_manager' => array(
        'template_path_stack' => array(
            'page-creator' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        ),
    ),
);