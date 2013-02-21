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
    /**
     * properti untuk menyimpan nama kontroller
     * @var string
     */
    public $controllerName ='';
    
    public function __construct($control) {
        $this->setControllerName($control);
    }
    
    /**
     * setter nama controller
     * @param string $control
     */
    public function setControllerName($control){
        $this->controllerName = $control;
    }
    
    /**
     * getter nama controller
     * @return string
     */
    public function getControllerName(){
        return $this->controllerName;
    }
    
    /**
     * method untuk merender view
     * @param mixed $params
     */
    public function render($params){
        if (is_array($params)){
            $view=$params[0];
            $viewFile = $view.'.php';
            include $this->getPathView().$viewFile;
        }
    }
    
    /**
     * method untuk getter view path
     * @return string path
     */
    public function getPathView(){
        $view = APP_PATH.'view'.DIRECTORY_SEPARATOR.$this->controllerName.DIRECTORY_SEPARATOR;
        return $view;
    }
    
    /**
     * method untuk parsing route
     * @param string $route
     * @return array
     */
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
    
    /**
     * method untuk mendapatkan action yang dijalankan
     * @param string $actionName
     */
    public function getAction($actionName){
        if (!empty($actionName)){
            $action = $this->generateAction($actionName);
            $this->$action($actionName);
        }
    }
    
    /**
     * menggenerate nama action
     * @param string $params nama action
     * @return string
     */
    private function generateAction($params){
        return 'action'.ucfirst(strtolower($params));
    }
    
}

?>
