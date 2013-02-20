<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CWeb
 *
 * @author sujana
 */
class CWeb {
    public $nama='Aplikasi Web';
    
    public function __construct($config) {
        if (is_string($config))
            $config = require $config;
        if (is_array($config)){
            foreach ($config as $key => $value) {
                $method = 'set'.ucfirst($key);
                $this->$method($value);
            }
        }
    }
    
    public function run(){
        return new CAplikasi;
    }
    
    public function setNama($nama){
        $this->nama = $nama;
    }
    
    public function getNama(){
        return $this->nama;
    }
}

?>
