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
//        echo CHtml::textField('test', 'haha', array('class'=>'dadar'));
//        echo CHtml::button('waw', 'haha', array('class'=>'dadar'));
        
//        echo CHtml::dropDownList('test', 1, array(0=>'test',1=>'haha'));
        
//        if (isset($_POST['Haha'])){
////            echo $_POST['Haha'];
//            echo  App::instance('CUrl')->createUrl('/test/test/', array('id'=>'test', 'idPe'=>20));
////            echo  App::instance('CUrl')->getBaseUrl();
//            exit();
//        }
//        echo CHtml::beginForm('test');
//        echo CHtml::textField('Haha', 20);
//        echo CHtml::submitButton('waw', 'haha', array('class'=>'dadar'));
//        echo CHtml::resetButton('waw', 'haha', array('class'=>'dadar'));
//        echo CHtml::endForm();   
        echo CHtml::checkbox('waw', 'haha', 'Test', array('class'=>'dadar'));
        echo CHtml::radioButton('waw', 'haha', 'Test', array('class'=>'dadar'));
        echo CHtml::textArea('waw', 'haha', array('class'=>'dadar'));
    }
}

?>
