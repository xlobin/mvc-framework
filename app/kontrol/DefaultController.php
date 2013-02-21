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
        Data::model()->findAll();
    }
}

?>
