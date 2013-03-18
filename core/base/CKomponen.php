<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CKomponen
 *
 * @author sujana
 */
class CKomponen {
    
    /**
     * getter loader
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        $getter = 'get'.$name;
        if (method_exists($this, $getter)){
            return $this->$getter();
        }else if (property_exists($this, $name)){
            return $this->$name;
        }else
            die('Property "'.get_class($this).'.'.$name.'" is not defined.');
    }
    
    /**
     * setter autoloader
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        $setter = 'set'.$name;
        if (method_exists($this, $setter)){
            $this->$setter($value);
        }
        else if (property_exists($this, $name)){
            $this->$name = $value;
        }else
            die('Property "'.get_class($this).'.'.$name.'" is not defined.');
    }
}

?>
