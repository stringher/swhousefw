<?php

/**
 * Description of StickyNotesTable
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Model/StickyNotesTable.php

namespace Modulo\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class ModuloTable extends AbstractTableGateway {

    protected $table = 'SIGMODUL';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('SIGDTINS ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Modulo();
            $entity->setId($row->SIGIDMOD)
                    ->setNote($row->SIGNOMOD)
                    ->setCreated($row->SIGDTINS);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getModulo($id) {
        $row = $this->select(array('id' => (int) $id))->current();
        if (!$row)
            return false;

        $modulo = new Entity\Modulo(array(
                    'id' => $row->SIGIMOD,
                    'note' => $row->SIGDTINS,
                    'created' => $row->SIGDTINS,
                ));
        return $modulo;
    }

    public function saveModulo(Entity\Modulo $modulo) {
        $data = array(
            'note' => $modulo->getNote(),
            'created' => $modulo->getCreated(),
        );

        $id = (int) $modulo->getId();

        if ($id == 0) {
            $data['created'] = date("Y-m-d H:i:s");
            if (!$this->insert($data))
                return false;
            return $this->getLastInsertValue();
        }
        elseif ($this->getModulo($id)) {
            if (!$this->update($data, array('id' => $id)))
                return false;
            return $id;
        }
        else
            return false;
    }

    public function removeModulo($id) {
        return $this->delete(array('id' => (int) $id));
    }

}