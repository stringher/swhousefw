<?php
namespace Accelular\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\AutoDiscover;


class AccelularController extends AbstractActionController {

    public function indexAction() {
 
    
        if (isset($_GET['wsdl'])) 
        {
            $this->handleWSDL();
        } else {
            $this->handleSOAP();
        }

       
        $view = new ViewModel();
        $view->setTerminal(true);
        exit();
    }

    public function handleWSDL() {
        
        $config = $this->getServiceLocator()->get('Config');
        $urlwsdl = $config['accelular']['urlwsdl'];

        //$complex_type_strategy = new ArrayOfTypeComplex();
        
        $autodiscover = new AutoDiscover();
        
        $autodiscover->setClass('Accelular\Controller\Service\Accelular');
        
      //  $autodiscover->setComplexTypeStrategy($complex_type_strategy);
        
        
        $autodiscover->setUri($urlwsdl);
        
        
        $wsdl = $autodiscover->generate();
        $wsdl = $wsdl->toDomDocument();

    //    echo $wsdl->saveXML();
        $autodiscover->handle();
        
    }

    public function handleSOAP() {
        
        $config = $this->getServiceLocator()->get('Config');
        
        $soap = new \Zend\Soap\Server($config['accelular']['urlwsdl']);
        
        $soap->setClass('Accelular\Controller\Service\Accelular');
        
        $soap->handle();
    }

}
