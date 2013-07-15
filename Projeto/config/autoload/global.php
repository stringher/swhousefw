<?php
// config/autoload/global.php
return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=sig;host=172.42.1.36;user=leo.stringher;pass=St1#gPk@13',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'accelular'=> array(
        'url' => 'http://sgc.teste.redetempo.com.br/clientes/bloqueio_financeiro?user=accelular&senha=46548S4D8A225646ADASDA1',
        'driver' => 'MyServer70',
        'user' => 'acsp10',
        'pass' => '3rp@4c5p',
        'urlwsdl' => 'http://localhost/acspfw/public/accelular?wsdl',
    ),
    
);

