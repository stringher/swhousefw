<?php

namespace Caixa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CaixaController extends AbstractActionController {

    protected $_listaTable;
    protected $_listaregistroTable;

    public function indexAction() {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function removeAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {
            $post_data = $request->getPost();
            $id = $post_data['id'];

            if (!$note_id = $this->getJuslancamentoTable()->cancelaLancto($id))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(
                                array('response' => true, 'id' => $note_id
                )));
            }
        }
        return $response;
    }

    public function consultacaixaAction() {

        $id = new \Caixa\Model\Entity\Caixa();

        if ($this->getEvent()->getRouteMatch()->getParam('controle') != 'xx') {
            $id->setControle($this->getEvent()->getRouteMatch()->getParam('controle'));
        } else {
            $id->setControle("");
        }

        if ($this->getEvent()->getRouteMatch()->getParam('historico') != 'xx')
            $id->setHistorico($this->getEvent()->getRouteMatch()->getParam('historico'));

        if ($this->getEvent()->getRouteMatch()->getParam('nomeorigem') != 'xx')
            $id->setNomeOrigem($this->getEvent()->getRouteMatch()->getParam('nomeorigem'));

        if ($this->getEvent()->getRouteMatch()->getParam('razaosocial') != 'xx')
            $id->setRazaosocial($this->getEvent()->getRouteMatch()->getParam('razaosocial'));

        if ($this->getEvent()->getRouteMatch()->getParam('nordem') != 'xx')
            $id->setNordem($this->getEvent()->getRouteMatch()->getParam('nordem'));

        if ($this->getEvent()->getRouteMatch()->getParam('obscaixa') != 'xx')
            $id->setObsCaixa($this->getEvent()->getRouteMatch()->getParam('obscaixa'));

        if ($this->getEvent()->getRouteMatch()->getParam('operacao') != 'xx')
            $id->setOperacao($this->getEvent()->getRouteMatch()->getParam('operacao'));

        if ($this->getEvent()->getRouteMatch()->getParam('operador') != 'xx')
            $id->setOperador($this->getEvent()->getRouteMatch()->getParam('operador'));

        if ($this->getEvent()->getRouteMatch()->getParam('produto') != 'xx')
            $id->setProduto($this->getEvent()->getRouteMatch()->getParam('produto'));

        if ($this->getEvent()->getRouteMatch()->getParam('quantidade') != '777')
            $id->setQuantidade($this->getEvent()->getRouteMatch()->getParam('quantidade'));

        if ($this->getEvent()->getRouteMatch()->getParam('valor') != '777')
            $id->setValor($this->getEvent()->getRouteMatch()->getParam('valor'));

        if ($this->getEvent()->getRouteMatch()->getParam('senha') != 'xx')
            $id->setSenha($this->getEvent()->getRouteMatch()->getParam('senha'));

        $viewModel = new ViewModel(array(
            'lista' => $this->getCaixaCertTable()->getCaixaLancto($id)));
        $viewModel->setTerminal(true);

        return $viewModel;
    }

    public function addAction() { 
        $request = $this->getRequest();
        $response = $this->getResponse();

        $lista = null;

        if ($request->isPost()) {
            $post_data = $request->getPost();

            $lista = new \Caixa\Model\Entity\Caixa();
            $lista->setControle($post_data['txtControle']);
            $lista->setHistorico($post_data['txtHistorico']);
            $lista->setNomeOrigem($post_data['txtNomeOrigem']);
            $lista->setRazaosocial($post_data['txtRazaosocial']);
            $lista->setNordem($post_data['txtNordem']);
            $lista->setObsCaixa($post_data['txtObsCaixa']);
            $lista->setOperacao($post_data['txtOperacao']);
            $lista->setOperador('AC0007');
            
            $lista->setProduto($post_data['selproduto']);
        
            // $lista->setOptions($post_data['txtOptions']);
            $lista->setSenha($post_data['txtSenha']);
            $lista->setQuantidade($post_data['txtQuantidade']);
            $lista->setValor($post_data['txtValor']);

            if (!$Nordem = $this->getJuslancamentoTable()->insereLancamento($lista))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(
                                array('response' => true, 'id' => $Nordem
                )));
            }

            $lista->setNordem($Nordem);

             $lista->setSenha($post_data['txtSenha']);
            $saveLista = $this->getCaixaCertTable()->insereCaixaCert($lista);
        }
        return $response;
    }

    public function getCaixaCertTable() {
        if (!$this->_listaTable) {
            $sm = $this->getServiceLocator();
            $this->_listaTable = $sm->get('Caixa\Model\CaixacertTable');
        }
        return $this->_listaTable;
    }

    public function getJuslancamentoTable() {
        if (!$this->_listaregistroTable) {
            $sm = $this->getServiceLocator();
            $this->_listaregistroTable = $sm->get('Caixa\Model\JuslancamentoTable');
        }
        return $this->_listaregistroTable;
    }

}