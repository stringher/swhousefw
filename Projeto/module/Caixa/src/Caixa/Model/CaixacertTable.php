<?php
namespace Caixa\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class CaixacertTable extends AbstractTableGateway {

    protected $table = 'JUS_CAIXCERT';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function insereCaixaCert(Entity\Caixa $caixa) {
        $data = array(
            'JUS_QTD' => $caixa->getQuantidade(),
            'JUS_RAZSOCIAL' => $caixa->getRazaoSocial(),
            'JUS_NOMORG' => $caixa->getNomeOrigem(),
            'JUS_HIS' => $caixa->getHistorico(),
            'JUS_OBSCAIX' => $caixa->getObsCaixa(),
            'JUS_CONTROLE' => $caixa->getControle(),
            'JUS_SENHA' => $caixa->getSenha(),
            'JUS_NORDEM' => $caixa->getNordem()
        );

        $id = (int) $caixa->getId();

        if ($id == 0) {
            //      $data['created'] = date("Y-m-d H:i:s");
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

    public function getCaixaLancto(Entity\Caixa $caixa) {

        $resultSet = $this->select(function (Select $select) use ($caixa) {

                    if ($caixa->getControle() != null) {
                        $controle = "JUS_CONTROLE='" . $caixa->getControle() . "'";
                    } else {
                        $controle = "1=1";
                    }

                    if ($caixa->getQuantidade() != null) {
                        $qtd = "JUS_QTD='" . $caixa->getQuantidade() . "'";
                    } else {
                        $qtd = "1=1";
                    }

                    if ($caixa->getRazaoSocial() != null) {
                        $razaosocial = "JUS_RAZSOCIAL='" . $caixa->getRazaoSocial() . "'";
                    } else {
                        $razaosocial = "1=1";
                    }

                    if ($caixa->getHistorico() != null) {
                        $his = "JUS_HIS='" . $caixa->getHistorico() . "'";
                    } else {
                        $his = "1=1";
                    }

                    if ($caixa->getNomeOrigem() != null) {
                        $nomor = "JUS_NOMORG='" . $caixa->getNomeOrigem() . "'";
                    } else {
                        $nomor = "1=1";
                    }


                    if ($caixa->getObsCaixa() != null) {
                        $obscx = "JUS_OBSCAIX='" . $caixa->getObsCaixa() . "'";
                    } else {
                        $obscx = "1=1";
                    }
                    
                      if ($caixa->getValor() != null) {
                        $valor = "VLPAGO='" . $caixa->getValor() . "'";
                    } else {
                        $valor = "1=1";
                    }
                    
                    
                          if ($caixa->getSenha() != null) {
                        $senha = "JUS_SENHA='" . $caixa->getSenha() . "'";
                    } else {
                        $senha = "1=1";
                    }
             

                    $select->columns(array('JUS_NORDEM', 'JUS_RAZSOCIAL', 'JUS_CONTROLE', 'JUS_QTD', 'JUS_HIS', 'JUS_OBSCAIX', 'JUS_NOMORG','JUS_SENHA' ))
                            ->join('JUS_LANCAMENTO', 'JUS_CAIXCERT.JUS_NORDEM= JUS_LANCAMENTO.CODLANCAMENTO', array('CODPRODUTOJ', 'CODOPERADOR', 'VLPAGO', 'STLANCAMENTO'), 'left')
                            ->where($razaosocial)
                            ->where($controle)
                            ->where($qtd)
                            ->where($his)
                            ->where($nomor)
                            ->where($obscx)
                            ->where($valor)
                            ->where($senha)
                            ->where("STLANCAMENTO !='CAN'");
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Caixa();
            $entity->setNordem($row->JUS_NORDEM)
                    ->setRazaosocial($row->JUS_RAZSOCIAL)
                    ->setControle($row->JUS_CONTROLE);
            $entities[] = $entity;
        }
        return $entities;
    }

}