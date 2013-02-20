<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CKontrol
 *
 * @author sujana
 */
class CKontrol{
    public $controllerName ='';
    
    public function __construct($control) {
        $this->setControllerName($control);
    }
    
    public function setControllerName($control){
        $this->controllerName = $control;
    }
    
    public function getControllerName(){
        return $this->controllerName;
    }
    
    public function render($params){
        if (is_array($params)){
            $view=$params[0];
            $viewFile = $view.'.php';
            include $this->getPathView().$viewFile;
        }
    }
    
    public function getPathView(){
        $view = APP_PATH.'view'.DIRECTORY_SEPARATOR.$this->controllerName.DIRECTORY_SEPARATOR;
        return $view;
    }
    
    private function parseRoute($route){
        if (!is_null($route)){
            $routes = explode('/',$route);
            $jumlah = count($route);

            $controller = $routes[0];
            if ($jumlah == 2){
                $action = $routes[1];
            }
        }
        return array('controller'=>(isset($controller) ? $controller : ''),'action'=>(isset($action) ? $action : ''));
    }
    
}

?>
