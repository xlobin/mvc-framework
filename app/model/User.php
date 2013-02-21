<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestingModel
 *
 * @author home
 */
class User extends CModel {
    public static function getTable() {
        return 'user';
    }
    
    public static function model($class = __CLASS__) {
        return parent::model($class);
    }
    
}

?>
