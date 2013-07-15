<?php

// module/StickyNotes/config/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'Registro\Controller\Registro' => 'Registro\Controller\RegistroController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'registro' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/registro[/:action][/:id][/:idregistro]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'idregistro' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Registro\Controller\Registro',
                        'action' => 'index',
                    ),
                ),
            ),
            'registrosview' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/registrosview[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Registro\Controller\Registro',
                        'action' => 'registrosview',
                    ),
                ),
            ),
            'insereregistro' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/insereregistro[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Registro\Controller\Registro',
                        'action' => 'insereregistro',
                    ),
                ),
            ),
            'editaregistro' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/editaregistro/[/:action][/:id][/:idregistro]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'idregistro' => '[0-9]+',
                    'defaults' => array(
                        'controller' => 'Registro\Controller\Registro',
                        'action' => 'editaregistro',
                    ),
                ),
                'may_terminate' => true,
            ),
              
  ),
            
 ), ),
    'view_manager' => array(
        'template_path_stack' => array(
            'registro' => __DIR__ . '/../view',
        ),
    ),
);
