<?php

/**
 * Description of StickyNotesController
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Controller/StickyNotesController.php:

namespace Modulo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ModuloController extends AbstractActionController {

    protected $_moduloTable;

    public function indexAction() {

        
        return new ViewModel(array(
                    'modulo' => $this->getModuloTable()->fetchAll(),
                ));
    }

    public function addAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $new_note = new \Modulo\Model\Entity\Modulo();
            if (!$note_id = $this->getModuloTable()->saveModulo($new_note))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true, 'new_note_id' => $note_id)));
            }
        }
        return $response;
    }

    public function removeAction() {
        echo'aqui';
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $note_id = $post_data['id'];
            if (!$this->getModuloTable()->removeModulo($note_id))
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
            $note_id = $post_data['id'];
            $note_content = $post_data['content'];
            $modulo = $this->getModuloTable()->getModulo($note_id);
            $modulo->setNote($note_content);
            if (!$this->getModuloTable()->saveModulo($modulo))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function getModuloTable() {
        if (!$this->_moduloTable) {
            $sm = $this->getServiceLocator();
            $this->_moduloTable = $sm->get('Modulo\Model\ModuloTable');
        }
        return $this->_moduloTable;
    }

}