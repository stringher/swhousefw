<?php
namespace Accelular\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TitulosPendentesController extends AbstractActionController
{
    protected $_jucespTable;

    public function indexAction()
    {
          $sqlAbstract = new \Accelular\Model\AccelularAbstract();
          
          $titulovencido =  $sqlAbstract->titulosAbertos();
          
          $config = $this->getServiceLocator()->get('Config');
          $url= $config['accelular']['url'];
                  
          //$url="http://accelular.com.br/clientes/bloqueio_financeiro?user=accelular&senha=46548S4D8A225646ADASDA1";
       
        
           // $array_bloq[] = array(
	//		'codigo_associado_ref'	=> 50000040,
	//		'cnpj_ref'=> '62876768000180',
	//		'mes_referencia'=> '30/04/2013',
	//		'identificador_titulo'	=> 231825677,
	//		'valor'=>'12.92',
	//		'vencimento_data'=> '10/06/2013'
	//	);
          
          
          
        $dados_clientes_bloqueio = json_encode(array('bloquear' => $titulovencido));
        
        $curl = curl_init($url);
        
        $curl_post_data = array(
		"dados_clientes_bloqueio" => $dados_clientes_bloqueio,
	);
     
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);

        $json_response = curl_exec($curl);

        echo $dados_clientes_bloqueio;
        
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
        if ( $status != 200 ) {
            die("Error: call to URL $url failed with status $status, response  $json_response , curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
            else
       {
             die($json_response);
       }
            
        
        curl_close($curl);

          $viewModel= new ViewModel();
          $viewModel->setTerminal(true);
       return $viewModel;
    }
    
    public function getJucespTable() {
        if (!$this->_jucespTable) {
            $sm = $this->getServiceLocator();
            $this->_jucespTable = $sm->get('Accelular\Model\JucespTable');
        }
        return $this->_jucespTable;
    }
}
