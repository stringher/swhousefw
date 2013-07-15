<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StickyNote
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Model/Entity/StickyNotes.php

namespace Accelular\Model\Entity;

class Accelular{

    protected $_id;
    protected $_recno;
    protected $_razao;
    protected $_emissao;
    protected $_menota;
    protected $_quantidade;
    
    protected $_prcven;
    
   protected $_valor;

   
      protected $_loja;
      
         protected $_cliente;
         
  protected $_tipcbr;
   protected $_contrato;      
                
          public function getTipcbr() {
        return $this->_tipcbr;
    }

    public function setTipcbr($id) {
        $this->_tipcbr= $id;
        return $this;
    }
    
           
          public function getContrato() {
        return $this->_contrato;
    }

    public function setContrato($id) {
        $this->_contrato= $id;
        return $this;
    }
         
         
          public function getLoja() {
        return $this->_loja;
    }

    public function setLoja($id) {
        $this->_loja= $id;
        return $this;
    }
    
             public function getCliente() {
        return $this->_cliente;
    }

    public function setCliente($id) {
        $this->_cliente= $id;
        return $this;
    }
   
        public function getValor() {
        return $this->_valor;
    }

    public function setValor($id) {
        $this->_valor= $id;
        return $this;
    }
   
       public function getPrcven() {
        return $this->_prcven;
    }

    public function setPrcven($id) {
        $this->_prcven = $id;
        return $this;
    }
   
       public function getQuantidade() {
        return $this->_quantidade;
    }

    public function setQuantidade($id) {
        $this->_quantidade = $id;
        return $this;
    }
   
       public function getMenota() {
        return $this->_menota;
    }

    public function setMenota($id) {
        $this->_menota = $id;
        return $this;
    }
   
       public function getEmissao() {
        return $this->_emissao;
    }

    public function setEmissao($id) {
        $this->_emissao = $id;
        return $this;
    }
   
       public function getRazao() {
        return $this->_razao;
    }

    public function setRazao($id) {
        $this->_razao = $id;
        return $this;
    }
   
    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }
    
        public function getRecno() {
        return $this->_recno;
    }

    public function setRecno($id) {
        $this->_recno = $id;
        return $this;
    }
    
 

    public function getNote() {
        return $this->_note;
    }

    public function setNote($note) {
        $this->_note = $note;
        return $this;
    }

    public function getCreated() {
        return $this->_created;
    }

    public function setCreated($created) {
        $this->_created = $created;
        return $this;
    }

}

?>
