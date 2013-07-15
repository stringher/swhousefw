<?php

// module/StickyNotes/config/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'Lista\Controller\Lista' => 'Lista\Controller\ListaController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'lista' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/lista[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Lista\Controller\Lista',
                        'action' => 'index',
                    ),
                ),
            ),
            'editalista' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/editalista[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Lista\Controller\Lista',
                        'action' => 'editalista',
                    ),
                ),
            ),
            'editalista' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/editalista[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Lista\Controller\Lista',
                        'action' => 'editalista',
                    ),
                ),
            ),
            'intranet' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/intranet[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Lista\Controller\Lista',
                        'action' => 'intranet',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'lista' => __DIR__ . '/../view',
        ),
    ),
);
