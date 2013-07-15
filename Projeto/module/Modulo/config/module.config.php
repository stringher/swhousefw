<?php

// module/StickyNotes/config/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'Modulo\Controller\Modulo' => 'Modulo\Controller\ModuloController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'modulo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/modulo[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Modulo\Controller\Modulo',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'modulo' => __DIR__ . '/../view',
        ),
    ),
);
