<?php



namespace Registro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegistroController extends AbstractActionController {

    protected $_registroTable;

    protected $_listaregistroTable;
    
    public function indexAction() {
         $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
        return new ViewModel(array(
                    'registro' => $this->getRegistroTable()->getRegistros($id),
                    'atributo' => $this->getListaRegistroTable()->getAtributoView($id),
                ));
    }
    
      public function insereregistroAction() {
         $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
        
         $viewModel = new ViewModel(array(
                    'lista' => $this->getListaRegistroTable()->getAtributoView($id),
                        'registro' => $this->getRegistroTable()->getRegistros($id),
                        'idlista'=> $id
                ));
        $viewModel->setTerminal(true);
        return $viewModel;
    }
    
    public function editaregistroAction() {
         $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
    
          $idRegistro = $this->getEvent()->getRouteMatch()->getParam('idregistro'); 
          
         $viewModel = new ViewModel(array(
                    'lista' => $this->getListaRegistroTable()->getAtributoView($id),
                        'registro' => $this->getRegistroTable()->getRegistrosEdit($idRegistro),
                        'idregistro'=> $idRegistro,
             'idlista'=> $id
                ));
        $viewModel->setTerminal(true);
        return $viewModel;
    }
    
    
    
    

     public function registrosviewAction() {
         $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
        
         $viewModel = new ViewModel(array(
                    'atributo' => $this->getListaRegistroTable()->getAtributoView($id),
                        'registro' => $this->getRegistroTable()->getRegistros($id)
                ));
$viewModel->setTerminal(true);
return $viewModel;
         
        
    }
    
    public function addAction() {
         $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
         
            
            $lista = new \Registro\Model\Entity\Registro();
            $lista->setIdLista($post_data['idlista']);
            $lista->setId(0);
            $lista->setAtrcol01($post_data['coluna_1']);
            $lista->setAtrcol02($post_data['coluna_2']);
            $lista->setAtrcol03($post_data['coluna_3']);
            $lista->setAtrcol04($post_data['coluna_4']);
            $lista->setAtrcol05($post_data['coluna_5']);
            $lista->setAtrcol06($post_data['coluna_6']);
            $lista->setAtrcol07($post_data['coluna_7']);
            $lista->setAtrcol08($post_data['coluna_8']);
            $lista->setNote($post_data['txtnomelista']);
            if (!$note_id = $this->getRegistroTable()->saveRegistro($lista))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(
                        array('response' => true, 'new_note_id' => $note_id
                        )));
            }
            
      
        }
        return $response;
    }

    public function removeAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $note_id = $post_data['id'];
            if (!$this->getRegistroTable()->removeRegistro($note_id))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function updateAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
         
            
            $lista = new \Registro\Model\Entity\Registro();
            $lista->setId($post_data['idregistro']);
             $lista->setIdLista($post_data['idlista']);
            $lista->setAtrcol01($post_data['coluna_1']);
            $lista->setAtrcol02($post_data['coluna_2']);
            $lista->setAtrcol03($post_data['coluna_3']);
            $lista->setAtrcol04($post_data['coluna_4']);
            $lista->setAtrcol05($post_data['coluna_5']);
            $lista->setAtrcol06($post_data['coluna_6']);
            $lista->setAtrcol07($post_data['coluna_7']);
            $lista->setAtrcol08($post_data['coluna_8']);
            $lista->setNote($post_data['txtnomelista']);
            if (!$note_id = $this->getRegistroTable()->saveRegistro($lista))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
            
      
        }
        return $response;
    }

    public function getRegistroTable() {
        if (!$this->_registroTable) {
            $sm = $this->getServiceLocator();
            $this->_registroTable = $sm->get('Registro\Model\RegistroTable');
        }
        return $this->_registroTable;
    }
    
     public function getListaRegistroTable() {
        if (!$this->_listaregistroTable) {
            $sm = $this->getServiceLocator();
            $this->_listaregistroTable = $sm->get('Registro\Model\ListaRegistroTable');
        }
        return $this->_listaregistroTable;
    }

}