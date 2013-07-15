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

namespace Registro\Model\Entity;

class Registro {

    protected $_id;
    protected $_note;
    protected $_created;
    protected $_atrcol01;
    protected $_atrcol02;
    protected $_atrcol03;
    protected $_atrcol04;
    protected $_atrcol05;
    protected $_atrcol06;
    protected $_atrcol07;
    protected $_atrcol08;
    protected $_atrcol09;
    protected $_atrcol10;

    protected $_regcol01;
    protected $_regcol02;
    protected $_regcol03;
    protected $_regcol04;
    protected $_regcol05;
    protected $_regcol06;
    protected $_regcol07;
    protected $_regcol08;
    protected $_regcol09;
    protected $_regcol10;
    
     protected $_listaid;
    
    
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

          public function getIdLista() {
        return $this->_listaid;
    }

    public function setIdLista($id) {
        $this->_listaid = $id;
        return $this;
    }
    //Registros
    
     public function getRegcol01() {
        return $this->_regcol01;
    }

    public function setRegcol01($note) {
        $this->_regcol01 = $note;
        return $this;
    }
    
     public function getRegcol02() {
        return $this->_regcol02;
    }

    public function setRegcol02($note) {
        $this->_regcol02 = $note;
        return $this;
    }
    
     public function getRegcol03() {
        return $this->_regcol03;
    }

    public function setRegcol03($note) {
        $this->_regcol03 = $note;
        return $this;
    }
    
    
     public function getRegcol04() {
        return $this->_regcol04;
    }

    public function setRegcol04($note) {
        $this->_regcol04 = $note;
        return $this;
    }
    
    
     public function getRegcol05() {
        return $this->_regcol05;
    }

    public function setRegcol05($note) {
        $this->_regcol05 = $note;
        return $this;
    }
    
     public function setRegcol06($note) {
        $this->_regcol06 = $note;
        return $this;
    }
    
     public function getRegcol06() {
        return $this->_regcol06;
    }

    public function setRegcol07($note) {
        $this->_regcol07 = $note;
        return $this;
    }
      public function getRegcol07() {
        return $this->_regcol07;
    }
    
     public function getRegcol08() {
        return $this->_regcol08;
    }

    public function setRegcol08($note) {
        $this->_regcol08 = $note;
        return $this;
    }
    
     public function getRegcol09() {
        return $this->_regcol09;
    }

    public function setRegcol09($note) {
        $this->_regcol09 = $note;
        return $this;
    }
    
     public function getRegcol10() {
        return $this->_regcol10;
    }

    public function setRegcol10($note) {
        $this->_regcol10 = $note;
        return $this;
    }
    
    
    //Atributos
    
    public function getAtrcol01() {
        return $this->_atrcol01;
    }

    public function setAtrcol01($note) {
        $this->_atrcol01 = $note;
        return $this;
    }
    
     public function getAtrcol02() {
        return $this->_atrcol02;
    }

    public function setAtrcol02($note) {
        $this->_atrcol02 = $note;
        return $this;
    }
    
     public function getAtrcol03() {
        return $this->_atrcol03;
    }

    public function setAtrcol03($note) {
        $this->_atrcol03 = $note;
        return $this;
    }
    
    
     public function getAtrcol04() {
        return $this->_atrcol04;
    }

    public function setAtrcol04($note) {
        $this->_atrcol04 = $note;
        return $this;
    }
    
    
     public function getAtrcol05() {
        return $this->_atrcol05;
    }

    public function setAtrcol05($note) {
        $this->_atrcol05 = $note;
        return $this;
    }
    
     public function setAtrcol06($note) {
        $this->_atrcol06 = $note;
        return $this;
    }
    
     public function getAtrcol06() {
        return $this->_atrcol06;
    }

       public function getAtrcol07() {
      return $this->_atrcol07;
    }
    
    public function setAtrcol07($note) {
        $this->_atrcol07 = $note;
        return $this;
    }
    
     public function getAtrcol08() {
        return $this->_atrcol08;
    }

    public function setAtrcol08($note) {
        $this->_atrcol08 = $note;
        return $this;
    }
    
     public function getAtrcol09() {
        return $this->_atrcol09;
    }

    public function setAtrcol09($note) {
        $this->_atrcol09 = $note;
        return $this;
    }
    
     public function getAtrcol10() {
        return $this->_atrcol10;
    }

    public function setAtrcol10($note) {
        $this->_atrcol10 = $note;
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
