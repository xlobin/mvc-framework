<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CDBConnection
 *
 * @author home
 */
class CDBConnection {
    /**
     * properti untuk menyimpan objek dari mysqli
     * @var object
     */
    public $db;
    /**
     * properti untuk menyimpan nama tabel
     * @var string
     */
    public $tableName;
    public function __construct($params) {
        if (!empty($params['databaseVendor'])){
            if ($params['databaseVendor'] == 'mysql'){
                $connect = new mysqli($params['databaseHost'], $params['databaseUser'], $params['databasePassword'], $params['databaseName']);
                $this->db = $connect;
                if ($this->db->connect_errno > 0){
                     die('Unable to connect to database [' . $this->db->connect_error . ']');
                }
            }
        }
    }
    
    /**
     * digunakan sebagai setter nama tabel
     * @param string $tableName
     */
    public function setTable($tableName){
        $this->tableName = $tableName;
    }
    
    /**
     * fetching data secara menyeluruh
     */
    public function findAll(){
        echo $this->tableName;
        echo print_r($this->db);
    }
}

?>
