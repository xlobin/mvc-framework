<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CAplikasi
 *
 * @author sujana
 */
class CAplikasi {
    public $route = '';
    
    public function __construct() {
        $this->setRequestRoute();
        $this->runAplikasi();
    }
    
    public function setRequestRoute(){
        if (isset($_GET['r'])){
            $this->route = $_GET['r'];
        }
    }
    
    public function getRequestRoute(){
        return $this->route;
    }
    
    private function runAplikasi(){
        if (!is_null($this->route)){
            $routes = $this->parseRoute();
            $action = (!empty($routes['action']) ? 'action'.ucfirst(strtolower($routes['action'])) : 'actionIndex');
            spl_autoload_register(array($this,'loadModel'));
            $this->runController($routes['controller'])->$action();
        }
    }
    
    private function parseRoute(){
        $routes = explode('/',$this->route);
        $jumlah = count($routes);

        $controller = $routes[0];
        if ($jumlah == 2){
            $action = $routes[1];
        }

        return array('controller'=>$controller,'action'=>(isset($action) ? $action : ''));
    }
    
    public function runController($control){
        include APP_PATH.'kontrol/'.ucfirst(strtolower($control)).'Controller.php';
        $className = ucfirst(strtolower($control)).'Controller';
        return new $className($control);
    }
    
    public function loadModel($class){
        if (!is_null($class)){
            include APP_PATH.DIRECTORY_SEPARATOR.'model'.ucfirst(strtolower($className)).'Model.php';
        }
    }
    
    
}

?>
