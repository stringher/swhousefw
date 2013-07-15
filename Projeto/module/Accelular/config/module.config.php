<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Accelular\Controller\Accelular' => 'Accelular\Controller\AccelularController',
            'Accelular\Controller\TitulosPendentes' => 'Accelular\Controller\TitulosPendentesController',
            'Accelular\Controller\ClienteService' => 'Accelular\Controller\ClienteServiceController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'accelular' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/accelular',
                    'defaults' => array(
                        'controller' => 'Accelular\Controller\Accelular',
                        'action' => 'index',
                    ),
                ),
            ),
            'enviatempo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/enviatempo[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Accelular\Controller\TitulosPendentes',
                        'action' => 'index',
                    ),
                ),
            ),
            'clienteservice' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/clienteservice[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Accelular\Controller\ClienteService',
                        'action' => 'index',
                    ),
                ),
            ),
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'accelular' => __DIR__ . '/../view',
        ),
    ),
);