<?php

/**
 * Description of StickyNotesTable
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Model/StickyNotesTable.php

namespace Registro\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class RegistroTable extends AbstractTableGateway {

    protected $table = 'SIGREGISTROS';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
    public function getRegistros($id) {
        $resultSet = $this->select(function (Select $select) use ($id)  {
            $select->where(array('SIGREGISTROS.ATRID' => (int) $id))
            //->where('SIGMODID =' + $id)
            ->order('REGDATA ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Registro();
            $entity->setId($row->REGID)
                    ->setRegcol01($row->REGCOL01)
                    ->setRegcol02($row->REGCOL02)
                    ->setRegcol03($row->REGCOL03)
                    ->setRegcol04($row->REGCOL04)
                    ->setRegcol05($row->REGCOL05)
                    ->setRegcol06($row->REGCOL06)
                    ->setRegcol07($row->REGCOL07)
                    ->setRegcol08($row->REGCOL08)
                   ->setCreated($row->REGDATA);
            $entities[] = $entity;
        }
        return $entities;
        
    
    $statement = $this->prepareStatementForSqlObject($select);
    $row = $statement->execute();
        
        
       // $row = $this->select(array('ATRID' => (int) $id))->current();
        if (!$row)
            return false;

 /////////////       $lista = new Entity\Registro(array(
              /////////////      'ATRID' => $row->ATRID,
               /////////////     'ATRLISTA' => $row->ATRCOL01,
                /////////////    'ATRDATA' => $row->ATRDATA,
            /////////////    ));
      /////////////  return $lista;
    }
/////////////
    
    
    public function getRegistrosEdit($id) {
        $resultSet = $this->select(function (Select $select) use ($id)  {
            $select->where(array('SIGREGISTROS.REGID' => (int) $id))
            //->where('SIGMODID =' + $id)
            ->order('REGDATA ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Registro();
            $entity->setId($row->REGID)
                    ->setRegcol01($row->REGCOL01)
                    ->setRegcol02($row->REGCOL02)
                    ->setRegcol03($row->REGCOL03)
                    ->setRegcol04($row->REGCOL04)
                    ->setRegcol05($row->REGCOL05)
                    ->setRegcol06($row->REGCOL06)
                    ->setRegcol07($row->REGCOL07)
                    ->setRegcol08($row->REGCOL08)
                   ->setCreated($row->REGDATA);
            $entities[] = $entity;
        }
        return $entities;
        
    
    $statement = $this->prepareStatementForSqlObject($select);
    $row = $statement->execute();
        
        
       // $row = $this->select(array('ATRID' => (int) $id))->current();
        if (!$row)
            return false;

 /////////////       $lista = new Entity\Registro(array(
              /////////////      'ATRID' => $row->ATRID,
               /////////////     'ATRLISTA' => $row->ATRCOL01,
                /////////////    'ATRDATA' => $row->ATRDATA,
            /////////////    ));
      /////////////  return $lista;
    }
    
    
    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('REGDATA ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Registro();
            $entity->setId($row->ATRID)
                    ->setRegcol01($row->REGCOL01)
                    ->setRegcol02($row->REGCOL02)
                    ->setRegcol03($row->REGCOL03)
                    ->setRegcol04($row->REGCOL04)
                    ->setRegcol05($row->REGCOL05)
                    ->setRegcol06($row->REGCOL06)
                    ->setRegcol07($row->REGCOL07)
                    ->setRegcol08($row->REGCOL08)
                    ->setCreated($row->REGDATA);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getRegistro($id) {
        $row = $this->select(array('REGID' => (int) $id))->current();
        if (!$row)
            return false;

        $registro = new Entity\Registro(array(
                    'REGID' => $row->ATRID,
                    'REGLISTA' => $row->ATRLISTA,
                    'REGDATA' => $row->ATRDATA,
                ));
        return $registro;
    }

    public function saveRegistro(Entity\Registro $registro) {
        $data = array(
            'ATRID' => $registro->getIdLista(),
            'REGCOL01' => $registro->getAtrcol01(),
            'REGCOL02' => $registro->getAtrcol02(),
            'REGCOL03' => $registro->getAtrcol03(),
            'REGCOL04' => $registro->getAtrcol04(),
            'REGCOL05' => $registro->getAtrcol05(),
            'REGCOL06' => $registro->getAtrcol06(),
            'REGCOL07' => $registro->getAtrcol07(),
            'REGCOL08' => $registro->getAtrcol08(),
            'REGSTATU' => '1',
        );

      
        $id = (int) $registro->getId();

        if ($id == 0) {
            //$data['created'] = date("Y-m-d H:i:s");
            if (!$this->insert($data))
                return false;
            return $this->getLastInsertValue();
        }
        else{
            if (!$this->update($data, array('REGID' => $id)))
                return false;
            return $id;
        }
    }

    public function removeRegistro($id) {
        return $this->delete(array('REGID' => (int) $id));
    }

}