<?php

namespace Accelular\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;


class JucespTable extends AbstractTableGateway {

    protected $table = 'JUS_PREFIXVAL';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    
    public function  getRecno() {
        
            $resultSet = $this->select(function (Select $select) {
                             $select->where(array('CODPREFIX' => (string) 'PBX'))
            //->where('SIGMODID =' + $id)
            ->order('CODPREFIX ASC');
                        
                    });
                
            foreach ($resultSet as $row) {
               $newVal = $row->VALOR +1;
            }

            $data = array(
                'VALOR' =>  $newVal,
            );

            
            
        //INSERE ULTIMO VALOR RECNO NA PREFIXVAL 
       if (!$this->update($data, array('CODPREFIX' => 'PBX')))
                return false;
       
            //return $this->getLastInsertValue();
        
        // RETORNO RECNO PARA INSERÇÃO NA PXB
        return  $newVal;
    }
    
    
    
    
    
   

}