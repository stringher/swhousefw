<?php
namespace Lista\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListaController extends AbstractActionController {

    protected $_listaTable;
    
    protected $_listaregistroTable;

    public function indexAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
        return new ViewModel(array(
            /* @var $id type */
                    'lista' => $this->getListaTable()->getLista($id),
                     'idmodulo'=> $id,
                ));
    }
    
     public function intranetAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
         $viewModel= new ViewModel(array(
            /* @var $id type */
                    'lista' => $this->getListaTable()->getLista($id),
                     'idmodulo'=> $id,
                ));
            $viewModel->setTerminal(true);
        return $viewModel;
    }
    
     public function editalistaAction() {
            $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
            $viewModel= new ViewModel(array(
            /* @var $id type */
                    'lista' => $this->getListaTable()->getListaInd($id),
                     'idmodulo'=> $id,
                ));
            $viewModel->setTerminal(true);
        return $viewModel;
    }
    
    public function novalistaAction() {
         $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
       // Turn off the layout, i.e. only render the view script.
        $viewModel = new ViewModel(array(
                     'idmodulo'=> $id,
                ));
        $viewModel->setTerminal(true);
        return $viewModel;
    }

    public function addAction() {
        // $id = $this->getEvent()->getRouteMatch()->getParam('id'); 
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
         
            
            $lista = new \Lista\Model\Entity\Lista();
            $lista->setId($post_data['idmodulo']);
            $lista->setAtrcol01($post_data['txtatrcol01']);
            $lista->setAtrcol02($post_data['txtatrcol02']);
            $lista->setAtrcol03($post_data['txtatrcol03']);
            $lista->setAtrcol04($post_data['txtatrcol04']);
            $lista->setAtrcol05($post_data['txtatrcol05']);
            $lista->setAtrcol06($post_data['txtatrcol06']);
            $lista->setAtrcol07($post_data['txtatrcol07']);
            $lista->setAtrcol08($post_data['txtatrcol08']);
            $lista->setNote($post_data['txtnomelista']);
            if (!$note_id = $this->getListaTable()->saveLista($lista))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(
                        array('response' => true, 'new_note_id' => $note_id
                        )));
            }
            
            $lista->setIdLista($note_id); 
            
            $saveLista = $this->getModuleTable()->saveModuleLista($lista);
            
        }
        return $response;
    }

    public function removeAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $note_id = $post_data['id'];
            if (!$this->getListaTable()->removeLista($note_id))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function updateAction() {
        // update post
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            
            $lista = new \Lista\Model\Entity\Lista();
            
            $lista->setIdLista($post_data['idmodulo']);
            $lista->setAtrcol01($post_data['txtatrcol01']);
            $lista->setAtrcol02($post_data['txtatrcol02']);
            $lista->setAtrcol03($post_data['txtatrcol03']);
            $lista->setAtrcol04($post_data['txtatrcol04']);
            $lista->setAtrcol05($post_data['txtatrcol05']);
            $lista->setAtrcol06($post_data['txtatrcol06']);
            $lista->setAtrcol07($post_data['txtatrcol07']);
            $lista->setAtrcol08($post_data['txtatrcol08']);
             $lista->setNote($post_data['txtnomelista']);
            
            if (!$this->getListaTable()->saveLista($lista))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function getListaTable() {
        if (!$this->_listaTable) {
            $sm = $this->getServiceLocator();
            $this->_listaTable = $sm->get('Lista\Model\ListaTable');
        }
        return $this->_listaTable;
    }
    
        public function getModuleTable() {
        if (!$this->_listaregistroTable) {
            $sm = $this->getServiceLocator();
            $this->_listaregistroTable = $sm->get('Lista\Model\ModuleTable');
        }
        return $this->_listaregistroTable;
    }

}