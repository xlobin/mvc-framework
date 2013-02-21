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
    /**
     * properti untuk nama aplikasi
     * @var string
     */
    public $nama='Aplikasi Web';
    /**
     * properti untuk koneksi database 
     * @var CDBconnection
     */
    public static $db='';
    
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
    
    /**
     * menjalankan aplikasi
     * @return CAplikasi
     */
    public function run(){
        return new CAplikasi();
    }
    
    /**
     * setter nama aplikasi
     * @param string $nama
     */
    public function setNama($nama){
        $this->nama = $nama;
    }
    
    /**
     * getter nama aplikasi
     * @return string
     */
    public function getNama(){
        return $this->nama;
    }
    
    /**
     * setter koneksi database
     * @param string $params nama db
     */
    public static function setDb($params){
        if (!empty($params)){
            if (is_array($params)){
                self::$db = new CDBConnection($params);
            }
        }
    }
    
    /**
     * getter koneksi database
     * @return CDBConnection
     */
    public function getDb(){
        return self::$db;
    }
}

?>
