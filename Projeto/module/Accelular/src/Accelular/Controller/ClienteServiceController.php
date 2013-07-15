<?php
    namespace Accelular\Controller;
    use Zend\View\Model\ViewModel;
    use Zend\Mvc\Controller\AbstractActionController;
    
    
    class ClienteServiceController extends AbstractActionController
        {
            // Armazena na variável o endereço do webserver no servidor
            private $_WSDL_URI = "http://localhost/acspfw/public/accelular?wsdl";
            
            
            public function indexAction() {
                
                
            // Instanciando o Zend Soap Cliente
            $client = new \Zend\Soap\Client($this->_WSDL_URI, array('soap_version'=>SOAP_1_1,
                                                                    'cache_wsdl'=>false,
                
                ));
           
        //  $client->setWsdlCache(false); 
             
            
        
           // var_dump('caralho');
           $obj = $client->welcame();
            
            
            // $associado = new \Accelular\Controller\Service\Accelular();
            // $obj = $associado->findAssociado('603031','111','','');
           //  var_dump($obj);
   
             $viewModel = new ViewModel(array(
                    // 'ola'=> $client->welcame(),
                ));
            $viewModel->setTerminal(true);
            return $viewModel;
             
            
            }
        } 