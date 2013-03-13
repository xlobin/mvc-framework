<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author home
 */
class DefaultController extends CKontrol {
    public function actionIndex(){
//        $criteria = new CDBCriteria();
//        $criteria->compare('id',1);
//        $data = User::model()->fetch($criteria);
//        echo '<pre>';
//        print_r($data);
        $session = new CSession();
        $session->setSession('test', 'hehehe');
    }
    
    public function actionTest(){
//        echo App::instance('CSession')->getSession('test');
        echo CHtml::textField('test', 'haha', array('class'=>'dadar'));
    }
    
}

?>
