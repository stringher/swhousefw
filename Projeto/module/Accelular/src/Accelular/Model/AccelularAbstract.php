<?php

namespace Accelular\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class AccelularAbstract extends AbstractTableGateway {

    public function __construct() { 
      $db_conn = mssql_connect("MyServer70","acsp10","3rp@4c5p") 
                or die( "<strong>ERROR: Connection to MYSERVER failed</strong>" );
         $msdb=mssql_select_db("PROTHEUS10",$db_conn);
    }
    
    public function  populaPBX010(Entity\Accelular $accelular) {
          $msquery = "INSERT INTO PBX010 (PBX_TIPO,PBX_CLIENT,PBX_LOJACL,PBX_ORIGEM,PBX_CODCOS,
              PBX_RAZAO,PBX_CONDPG,PBX_EMISSA,PBX_MENOTA,PBX_CONTRA,PBX_NATURE , PBX_ITEM,
              PBX_PRODUT,PBX_QTDVEN,PBX_PRCVEN,PBX_VALOR,PBX_TES,PBX_STATUS,PBX_TIPOCB,
              PBX_BANCO,PBX_AGENC,PBX_CONTA,R_E_C_N_O_
            ) VALUES(" .
                    "'N'" . "," //PBX_TIPO X
                    . "'" . $accelular->getCliente() ."'," //PBX_CLIENT'=>'',
                    . "'" . $accelular->getLoja() ."',"  //'PBX_LOJACL'=>'',
                    . "'ACS110'". ","  // PBX_ORIGEM'=> ,
                    . "'" . $accelular->getId() ."'," //'PBX_CODCOS'=>'',
                    . "'" . $accelular->getRazao() ."'," //'PBX_RAZAO'=>'',
                    ."'502'". "," // 'PBX_CONDPG'=>,
                    . "'" . $accelular->getEmissao() ."'," //  'PBX_EMISSA'=>'',
                    . "'" . $accelular->getMenota() ."'," //  'PBX_MENOTA'=>'',
                     . "'" . $accelular->getContrato() ."'," //  'PBX_CONTRA'=>'',
                    ."'01',"   //  'PBX_NATURE',
                    . "'1'," // 'PBX_ITEM'=>'',
                    ."'ACSPCELV'"  . "," //  'PBX_PRODUT'=>,
                    . $accelular->getQuantidade() . "," // 'PBX_QTDVEN'=>'',
                    . $accelular->getPrcven() . "," //  'PBX_PRCVEN'=>'',
                    . $accelular->getValor() . "," // 'PBX_VALOR'=>'',
                    . "'702'," //  'PBX_TES'=>'',
                    . "'1'," // 'PBX_STATUS'=>'',
                     . $accelular->getTipcbr() . "," // 'PBX_TIPOCB'=>'',
                    . "'237'" . "," //  'PBX_BANCO'=>'237',
                    . "'00990'". "," //  'PBX_AGENC'=>'0099-0',
                    . "'1348-0'". "," // 'PBX_CONTA'=>'1348-0' ,
                    . $accelular->getRecno() . ")" ; //RECNO
                    
                    echo $msquery;
                    mssql_query($msquery);
          
                 return true;
       
    }
  
    public function  validaAssociado($id,$cnpj) {
        $msquery = "Select * 
            FROM SA1010  where A1_CODCOS=" . $id;
        $msresults= mssql_query($msquery);
            
      
        
        // echo mssql_fetch_array($msresults);
        return mssql_fetch_array($msresults);
    }
    
        public function  titulosAbertos() {
          $msquery = "SELECT " .
                    "E1_CODCOS,S1.R_E_C_N_O_, E1_VENCTO,E1_VALOR " .
                    "FROM " .
                    "PROTHEUS10.dbo.SD2010 AS S2, PROTHEUS10.dbo.SE1010 AS S1 ".
                    "where S2.D2_COD = 'ACSPCELU' " .
                    "and S2.R_E_C_N_O_ = S1.R_E_C_N_O_ " . 
                    "and E1_BAIXA= '' ";
            
        $msresults= mssql_query($msquery);
        
        
        
           while ($row = mssql_fetch_array($msresults)) {
            
              $teste= array( "codigo_associado_ref" => 50000040 ,
                    "cnpj_ref"=> '62876768000180',
                    "mes_referencia"=> '30/04/2013', 
                    "identificador_titulo"=>231825677,
                    "valor"=>200000.59,
                    "vencimento_data"=> '10/06/2013');
                }
             
            // $teste= array( "codigo_associado_ref" => $row['E1_CODCOS'] ,
              //      "cnpj_ref"=> $row['E1_CODCOS'],
              //      "mes_referencia"=> "01/12", 
              //      "identificador_titulo"=>$row['S1.R_E_C_N_O_'],
              //      "valor"=>$row['E1_VALOR'],
              //      "vencimento_data"=> "10/01/2013");
              //  }
            $data = array($teste);
                   
                   
        return $data;
    }
    
    
     public function  retornaTipoCb($id) {
        $msquery = "select PB1_PGCONS FROM PB1010 where PB1_CODCOS=" . $id;
        $msresults= mssql_query($msquery);
            
        $entity ='';
        while ($row = mssql_fetch_array($msresults)) {
            $entity=$row['PB1_PGCONS'];
        }
        return $entity;
    }
    
   

}