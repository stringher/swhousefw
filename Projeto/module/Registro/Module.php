<?php

/**
 * Description of Module
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
//  module/StickyNotes/Module.php

namespace Registro;

class Module {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Registro\Model\RegistroTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\RegistroTable($dbAdapter);
                    return $table;
                },
                 'Registro\Model\ListaRegistroTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\ListaRegistroTable($dbAdapter);
                    return $table;
                },       
            ),
        );
    }

}
