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
     * fetch semua data dari database dengan query atau
     * @param mixed $criteria dapat berupa instance dari cdbcriteria atau berupa string
     * @return object
     */
    public function fetchAll($criteria=null){
        $sql = 'select *from '.$this->tableName.' ';
        if (isset($criteria)){
            if ($criteria instanceof CDBCriteria){
                $sql = $criteria->createCommand('read', $this->tableName, $criteria);
            }else{
                if (!is_string($criteria)){
                    $criteria = '';
                }
                $sql .= $criteria;
            }
        }
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
     * fetch data dari database dengan hasil 1
     * @param mixed $criteria
     * @return object
     */
    public function fetch($criteria = null){
        if (isset($criteria)){
            if ($criteria instanceof CDBCriteria){
                $criteria->limit = array('limit'=>1);
            }else{
                $criteria .= ' limit 1';
            }
        }
        $result = $this->fetchAll($criteria);
        return $result[0];
    }
    
    public function delete($criteria = null){
        $sql = 'delete from '.$this->tableName.' ';
        if (isset($criteria)){
            if ($criteria instanceof CDBCriteria){
                $sql = $criteria->createCommand('delete', $this->tableName, $criteria);
            }
            else{
                if (!is_string($criteria)){
                    $criteria = '';
                }
                $sql.=$criteria;
            }
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
