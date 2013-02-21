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
    public $column = array();
    /**
     * properti untuk menyimpan nama tabel
     * @var string
     */
    public $tableName;
    public function __construct($params) {
        if (!empty($params['databaseConnection'])){
            $connect = new PDO($params['databaseConnection'], $params['databaseUser'], $params['databasePassword']);
            $this->db = $connect;
        }
    }
    
    /**
     * digunakan sebagai setter nama tabel
     * @param string $tableName
     */
    public function setTable($tableName){
        $this->tableName = $tableName;
        $this->setColumn();
    }
    
    /**
     * fetching data secara menyeluruh
     */
    public function fetchAll(){
        $sql = 'select *from '.$this->tableName;
        $query = $this->db->prepare($sql);
        if ($query->execute()){
            $return = array();
            $results = $query->rowCount();
            for ($index = 0; $index < $results; $index++) {
                $return[$index] = $query->fetchObject();
            }
            
            return $return;
        }
    }
    
    /**
     * method getter attribut table
     * @return array
     */
    public function getColumnTable(){
        
        $sql = 'show columns from '.$this->tableName;
        $query = $this->db->prepare($sql);
        if ($query->execute()){
            $result = array();
            $jumlah = $query->rowCount();
            for ($index = 0; $index < $jumlah; $index++) {
                $result[$index] = $query->fetchObject();
            }
        }
        
        return $result;
        
    }
    
    /**
     * method untuk set column table
     */
    public function setColumn(){
        $this->column = $this->getColumnTable();
    }
    
    /**
     * method untuk getter column table
     * @return array
     */
    public function getColumn(){
        return $this->column;
    }
}

?>
