<?php

namespace Accelular\Controller\Service;

use \stdClass;
use SoapVar;

class Accelular {
    
    /**
    * @return string
    */
    public function welcame() {
        return "ola";
    } 

    /**
     * Consulta os dados de um associado pelo código e CNPJ
     * @param string $cod codigo do associado
     * @param string $cnpj cnpj do associado 
     * @param string $user usuario do consumo
     * @param string $pass senha do consumidor
     * @return object
     */
    public function findAssociado($cod, $cnpj, $user, $pass) {


        if (!is_string($cod) || $cod == '') {
            $xml = $this->toXml(array(
                'status' => array(
                    'codigo' => 4,
                    'mensagem' => 'Erro Parametro'
                ),
                'dados' => array()
            ));

            $params = new \stdClass();
            $params->retorno = new SoapVar($xml, XSD_ANYXML);
            return $params;
        }

        if (!is_string($cnpj) || $cnpj == '') {
            $xml = $this->toXml(array(
                'status' => array(
                    'codigo' => 4,
                    'mensagem' => 'Erro Parametro'
                ),
                'dados' => array()
            ));

            $params = new \stdClass();
            $params->retorno = new SoapVar($xml, XSD_ANYXML);
            return $params;
        }

        $cod = str_pad($cod, 8, '0', STR_PAD_LEFT);
        $cnpj = preg_replace('/[-.\/]/', "", $cnpj);
        
       

        $validaAssociado = new \Accelular\Model\AccelularAbstract();
        $associado = $validaAssociado->validaAssociado($cod, $cnpj);

        $xml = $this->toXml($associado[1]);

        if (!isset($associado['A1_CODCOS'])) {
            $xml = $this->toXml(array(
                'status' => array(
                    'codigo' => 2,
                    'mensagem' => 'Registro nao encontrado'
                ),
                'dados' => array()
            ));
        } else {
            $return_data = array();
			$return_data_keys = array(
				'A1_CODCOS' => 'cod',
				'A1_NOME'	=> 'razao',
				'A1_NREDUZ'	=> 'nome_fant',
				'A1_CGC'	=> 'cnpj',
				'A1_TIPLOG'	=> 'logr',
				'A1_END'	=> 'end',
				'A1_NUMERO'	=> 'numero',
				'A1_COMPL'	=> 'compl',
				'A1_BAIRRO'	=> 'bairro',
				'A1_MUN'	=> 'cidade',
				'A1_EST'	=> 'uf',
				'A1_CEP'	=> 'cep',
				'A1_TEL'	=> 'tel',
				'A1_EMAIL'	=> 'email',
				'A1_CONTATO'=> 'contato',
				'A1_CONDGER'=> 'condicao'
			);
                        
                        foreach($return_data_keys as $a1key => $key)
				if(strlen(trim($associado[$a1key])) > 0)
					$return_data[$key] = $associado[$a1key];
			
			$xml = $this->toXml(array(
				'status' => array(
					'codigo' => 3,
					'mensagem' => 'Consulta realizada'
				),
				'dados' => $return_data
			));
        }


        $params = new \stdClass();
        $params->retorno = new SoapVar($xml, XSD_ANYXML);
        return $params;
    }

    protected $_jucespTable;

    public function atualizaPBXAccel($xml) {
        //LEITURA DO XML DA TEMPO

        $xmlobj = simplexml_load_file($xml);

        $validaAssociado = new \Accelular\Model\AccelularAbstract();

        //VARRE XML ENVIADO PELA TEMPO
        foreach ($xmlobj->item as $item) {
            $recno = 0;
            //VALIDAR ASSOCIADO
            $codcos = $item->codcos;
            $associadoexiste = $validaAssociado->validaAssociado($codcos);

            // VERIFICA ASSOCIADO ENCONTRADO   
            if (!$associadoexiste) {
                if (prev($item))
                    prev($item);
                else
                    break;
            }
            else {
                $recno = $this->getJucespTable()->getRecno();
            }

            // VERIFICA RECNO 
            if (!$recno)
                return '<status><codigo>3</codigo><mensagem>OK</mensagem></status>
                        <dados><registros>10</registros></dados>';
            else {
                //POPULA PBX    
                $pbxitem = new \Accelular\Model\Entity\Accelular();
                $pbxitem->setId($item->codcos);
                $pbxitem->setRecno($recno);
                $pbxitem->setRazao($item->razao);
                $pbxitem->setEmissao($item->emissa);
                $pbxitem->setMenota($item->menota);
                $pbxitem->setQuantidade('1');
                $pbxitem->setPrcven($item->prcven);
                $pbxitem->setValor($item->valor);
                $iparr = explode(";", $associadoexiste);
                $pbxitem->setLoja($iparr[1]);
                $pbxitem->setCliente($iparr[2]);
                $pbxitem->setTipCbr($iparr[3]);
                $pbxitem->setContrato($iparr[4]);

                $recno = $validaAssociado->populaPBX010($pbxitem);
            }
        }


        return '<status><codigo>3</codigo><mensagem>OK</mensagem></status>
                <dados><registros>10</registros></dados>';
    }

    public function getJucespTable() {
        if (!$this->_jucespTable) {
            $sm = $this->getServiceLocator();
            $this->_jucespTable = $sm->get('Accelular\Model\JucespTable');
        }
        return $this->_jucespTable;
    }

    /**
     * Transforma um array multidimensional em uma estrutura xml simples para retorno da WS
     *
     * @param array $arr
     * @return string
     */
    private function toXml($arr) {
        if (!is_array($arr))
            return null;
        $xml = '';
        foreach ($arr as $k => $v) {
            if (!is_array($v)) {
                $xml .= "<{$k}>{$v}</{$k}>";
            } else {
                if (substr($k, 0, 7) == 'struct:') {
                    $node_name = substr($k, 7, strlen($k));
                    foreach ($v as $key => $val) {
                        $xml .= "<{$node_name}>" . $this->toXml($val) . "</{$node_name}>";
                    }
                } else {
                    $xml .= "<{$k}>" . $this->toXml($v, $k) . "</{$k}>";
                }
            }
        }
        return $xml;
    }

}