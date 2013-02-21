<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CModel
 *
 * @author home
 */
class CModel {
    public $db;
    
    /**
     * mengkoneksikan dengan database 
     * @return CDBConnection
     */
    public static function getDBConnect(){
        $database = CWeb::$db;
        if ($database instanceof CDBConnection){
            return $database;
        }
    }
    
    /**
     * method untuk setter tabel dari model ke koneksi
     * @param object $classModel
     * @return CDBConnection yang telah diset tabel
     */
    public static function model($class){
        $model = new $class;
        self::getDBConnect()->setTable($model->getTable());
        return self::getDBConnect();
    }
    
    
    
}

?>
