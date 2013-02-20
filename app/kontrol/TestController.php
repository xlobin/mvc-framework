<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestController
 *
 * @author sujana
 */
class TestController extends CKontrol {
    public function actionTest(){
        new Testing();
        $this->render(array('test'));
    }
}

?>
