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

namespace Caixa\Model\Entity;

class Caixa {

    protected $_id;
    protected $_note;
    protected $_created;
    protected $_operacao;
    protected $_produto;
    protected $_quantidade;
    protected $_razaosocial;
    protected $_nomeorigem;
    protected $_historico;
    protected $_obscaixa;
    protected $_controle;
    protected $_nordem;
    protected $_operador;
    
    protected $_valor;
    
    protected $_senha;
    
    
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

    //Atributos
    
    public function getValor() {
        return $this->_valor;
    }

    public function setValor($note) {
        $this->_valor = $note;
        return $this;
    }
    
    
    public function getSenha() {
        return $this->_senha;
    }

    public function setSenha($note) {
        $this->_senha = $note;
        return $this;
    }
    
    public function getOperacao() {
        return $this->_operacao;
    }

    public function setOperacao($note) {
        $this->_operacao = $note;
        return $this;
    }
    
     public function getProduto() {
        return $this->_produto;
    }

    public function setProduto($note) {
        $this->_produto = $note;
        return $this;
    }
    
     public function getQuantidade() {
        return $this->_quantidade;
    }

    public function setQuantidade($note) {
        $this->_quantidade = $note;
        return $this;
    }
    
    
     public function getRazaoSocial() {
        return $this->_razaosocial;
    }

      public function setRazaosocial($note) {
        $this->_razaosocial = $note;
        return $this;
    }
 
    
        
     public function getNomeOrigem() {
        return $this->_nomeorigem;
    }
   public function setNomeOrigem($note) {
        $this->_nomeorigem = $note;
        return $this;
    }
  
    
     public function setHistorico($note) {
        $this->_historico = $note;
        return $this;
    }
    
     public function getHistorico() {
        return $this->_historico;
    }

       public function getObsCaixa() {
      return $this->_obscaixa;
    }
    
    public function setObsCaixa($note) {
        $this->_obscaixa = $note;
        return $this;
    }
    
     public function getControle() {
        return $this->_controle;
    }

    public function setControle($note) {
        $this->_controle = $note;
        return $this;
    }
    
     public function getNordem() {
        return $this->_nordem;
    }

    public function setNordem($note) {
        $this->_nordem = $note;
        return $this;
    }
    
     public function getOperador() {
        return $this->_operador;
    }

    public function setOperador($note) {
        $this->_operador = $note;
        return $this;
    }
   
}

?>
