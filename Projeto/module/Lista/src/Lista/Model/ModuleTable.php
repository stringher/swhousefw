<?php

namespace Lista\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;


class ModuleTable extends AbstractTableGateway {

    protected $table = 'SIGMODLI';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    
    /// SAVE LISTA 
    public function saveModuleLista(Entity\Lista $lista) {
        $data = array(
            'SIGMODID' => $lista->getId(),
            'SIGIDLIS' => $lista->getIdLista(),
        );

     
       // $id = (int) $lista->getIdLista();

        //if ($id == 0) {
            //$data['created'] = date("Y-m-d H:i:s");
            if (!$this->insert($data))
                return false;
            return $this->getLastInsertValue();
           }

    public function removeLista($id) {
        return $this->delete(array('SIGIDLIS' => (int) $id));
    }

}