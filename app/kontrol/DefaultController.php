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
        $data = User::model()->fetchAll($criteria);
        echo '<pre>';
        print_r($data);
    }
}

?>
