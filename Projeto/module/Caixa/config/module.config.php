<?php

// module/StickyNotes/config/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'Caixa\Controller\Caixa' => 'Caixa\Controller\CaixaController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'caixa' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/caixa[/:action][/:id][/:razaosocial][/:controle][/:historico][/:nomeorigem][/:nordem][/:obscaixa][/:quantidade][/:valor][/:senha]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                         'razaosocial' => '[a-zA-Z0-9_-]*',
                         'controle' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'historico' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'nomeorigem' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'nordem' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'obscaixa' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'quantidade' => '[0-9]+',
                         'valor' => '[0-9]+',
                         'senha' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Caixa\Controller\Caixa',
                        'action' => 'index',
                    ),
                ),
            ),
              'consultacaixa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/consultacaixa[/:action][/:id][/:razaosocial][/:controle][/:historico][/:nomeorigem][/:nordem][/:obscaixa][/:quantidade][/:valor][/:senha]',
                    'constraints' => array(
                       'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'razaosocial' => '[a-zA-Z0-9_-]*',
                        'controle' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'historico' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'nomeorigem' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'nordem' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'obscaixa' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'quantidade' => '[0-9]+',
                         'valor' => '[0-9]+',
                         'senha' => '[a-zA-Z0-9_-]*',
                        'defaults' => array(
                        'controller' => 'Caixa\Controller\Caixa',
                        'action' => 'consultacaixa',
                    
                    ),
          
                 ),
                'may_terminate' => true,
            ), 
        ),
   
      ),      
      ),       
     'module_layouts' => array(
        'Caixa' => '/layout/layout'),
    'view_manager' => array(
        'template_path_stack' => array(
            'caixa' => __DIR__ . '/../view',
        ),
    ),
);
