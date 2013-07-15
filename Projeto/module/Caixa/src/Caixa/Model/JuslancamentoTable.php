<?php
namespace Caixa\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;


class JuslancamentoTable extends AbstractTableGateway {

    protected $table = 'JUS_LANCAMENTO';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
     public function  cancelaLancto($id) {
         $data = array(
                'STLANCAMENTO' => 'CAN',
              );
         
     if (!$this->update($data, array('CODLANCAMENTO' => $id)))
                return false;
         return $id;
    }

    
    public function  insereLancamento(Entity\Caixa $caixa) {
              

        
        $data = array(
            'CODPRODUTOJ' => (string)$caixa->getProduto(),
            'CODOPERADOR' => $caixa->getOperador(),
            'VLPAGO' => $caixa->getValor()   ,
            'STLANCAMENTO' => "AB",
            'TPLANCAMENTO' => "AVI",
            'CODJUNTA' => "BVT",
            'STPROTHEUS' => "PEN",
            'NUATENDIMENTO' => date("Y"). date("m") .date("d") .'BVT'. (string) $caixa->getSenha()   
       );
   
        $id = (int) $caixa->getId();
        if ($id == 0) {
          //  $data['created'] = date("Y-m-d H:i:s");
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
    
    
    
    
    
   

}