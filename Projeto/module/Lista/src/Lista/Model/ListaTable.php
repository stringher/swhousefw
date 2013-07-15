<?php

namespace Lista\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class ListaTable extends AbstractTableGateway {

    protected $table = 'SIGATRBT';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('ATRDATA ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Lista();
            $entity->setId($row->ATRID)
                    ->setNote($row->ATRLISTA)
                    ->setCreated($row->ATRDATA);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getLista($id) {
        $resultSet = $this->select(function (Select $select) use ($id)  {
            $select->columns(array('ATRID', 'ATRLISTA', 'ATRDATA','ATRSTATU','ATRCOL01','ATRCOL02','ATRCOL03','ATRCOL04','ATRCOL05','ATRCOL06','ATRCOL07','ATRCOL08'))
            ->join('SIGMODLI', 'SIGATRBT.ATRID= SIGMODLI.SIGIDLIS',array('SIGMODID'), 'left')
            ->join('SIGMODUL', 'SIGMODLI.SIGMODID = SIGMODUL.SIGIDMOD'  )
            ->where('ATRSTATU = 1')
            ->where(array('SIGMODID' => (int) $id))
            //->where('SIGMODID =' + $id)
            ->order('ATRDATA ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Lista();
            $entity->setId($row->ATRID)
                    ->setNote($row->ATRLISTA)
                    ->setCreated($row->ATRDATA)
                    ->setAtrcol01($row->ATRCOL01)
                    ->setAtrcol02($row->ATRCOL02)
                    ->setAtrcol03($row->ATRCOL03)
                    ->setAtrcol04($row->ATRCOL04)
                    ->setAtrcol05($row->ATRCOL05)
                    ->setAtrcol06($row->ATRCOL06)
                    ->setAtrcol07($row->ATRCOL07)
                    ->setAtrcol08($row->ATRCOL08);
            $entities[] = $entity;
        }
        return $entities;
        
    
    $statement = $this->prepareStatementForSqlObject($select);
    $row = $statement->execute();
        
        
       // $row = $this->select(array('ATRID' => (int) $id))->current();
        if (!$row)
            return false;

        $lista = new Entity\Lista(array(
                    'ATRID' => $row->ATRID,
                    'ATRLISTA' => $row->ATRLISTA,
                    'ATRDATA' => $row->ATRDATA,
                ));
        return $lista;
    }

    
    //////
    
    public function getListaInd($id) {
        $resultSet = $this->select(function (Select $select) use ($id)  {
            $select->columns(array('ATRID', 'ATRLISTA', 'ATRDATA','ATRSTATU','ATRCOL01','ATRCOL02','ATRCOL03','ATRCOL04','ATRCOL05','ATRCOL06','ATRCOL07','ATRCOL08'))
            ->join('SIGMODLI', 'SIGATRBT.ATRID= SIGMODLI.SIGIDLIS',array('SIGMODID'), 'left')
            ->join('SIGMODUL', 'SIGMODLI.SIGMODID = SIGMODUL.SIGIDMOD'  )
            ->where('ATRSTATU = 1')
            ->where(array('ATRID' => (int) $id))
            //->where('SIGMODID =' + $id)
            ->order('ATRDATA ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Lista();
            $entity->setId($row->ATRID)
                    ->setNote($row->ATRLISTA)
                    ->setCreated($row->ATRDATA)
                    ->setAtrcol01($row->ATRCOL01)
                    ->setAtrcol02($row->ATRCOL02)
                    ->setAtrcol03($row->ATRCOL03)
                    ->setAtrcol04($row->ATRCOL04)
                    ->setAtrcol05($row->ATRCOL05)
                    ->setAtrcol06($row->ATRCOL06)
                    ->setAtrcol07($row->ATRCOL07)
                    ->setAtrcol08($row->ATRCOL08);
            $entities[] = $entity;
        }
        return $entities;
        
    
    $statement = $this->prepareStatementForSqlObject($select);
    $row = $statement->execute();
        
        
       // $row = $this->select(array('ATRID' => (int) $id))->current();
        if (!$row)
            return false;

        $lista = new Entity\Lista(array(
                    'ATRID' => $row->ATRID,
                    'ATRLISTA' => $row->ATRLISTA,
                    'ATRDATA' => $row->ATRDATA,
                ));
        return $lista;
    }

    
    /// SAVE LISTA 
    public function saveLista(Entity\Lista $lista) {
        $data = array(
            'ATRLISTA' => $lista->getNote(),
            'ATRCOL01' => $lista->getAtrcol01(),
            'ATRCOL02' => $lista->getAtrcol02(),
            'ATRCOL03' => $lista->getAtrcol03(),
            'ATRCOL04' => $lista->getAtrcol04(),
            'ATRCOL05' => $lista->getAtrcol05(),
            'ATRCOL06' => $lista->getAtrcol06(),
            'ATRCOL07' => $lista->getAtrcol07(),
            'ATRCOL08' => $lista->getAtrcol08(),
            'ATRSTATU' => '1',
        );

      
        $id = (int) $lista->getIdLista();

        if ($id == 0) {
            //$data['created'] = date("Y-m-d H:i:s");
            if (!$this->insert($data))
                return false;
            return $this->getLastInsertValue();
        }
        else{
            if (!$this->update($data, array('ATRID' => $id)))
                return false;
            return $id;
        }
    }

    public function removeLista($id) {
        return $this->delete(array('ATRID' => (int) $id));
    }

}