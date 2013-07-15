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

class ListaRegistroTable extends AbstractTableGateway {

    protected $table = 'SIGATRBT';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
    public function getAtributoView($id) {
        $resultSet = $this->select(function (Select $select) use ($id)  {
            $select->where(array('SIGATRBT.ATRID' => (int) $id))
            //->where('SIGMODID =' + $id)
            ->order('ATRDATA ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Registro();
            $entity->setId($row->ATRID)
                    ->setAtrcol01($row->ATRCOL01)
                    ->setAtrcol02($row->ATRCOL02)
                    ->setAtrcol03($row->ATRCOL03)
                    ->setAtrcol04($row->ATRCOL04)
                    ->setAtrcol05($row->ATRCOL05)
                    ->setAtrcol06($row->ATRCOL06)
                    ->setAtrcol07($row->ATRCOL07)
                    ->setAtrcol08($row->ATRCOL08)
                    ->setCreated($row->ATRDATA);
            $entities[] = $entity;
        }
        return $entities;
        
    
    $statement = $this->prepareStatementForSqlObject($select);
    $row = $statement->execute();
        
        
       // $row = $this->select(array('ATRID' => (int) $id))->current();
        if (!$row)
            return false;

        $lista = new Entity\Registro(array(
                    'ATRID' => $row->ATRID,
                    'ATRLISTA' => $row->ATRCOL01,
                    'ATRDATA' => $row->ATRDATA,
                ));
        return $lista;
    }
}