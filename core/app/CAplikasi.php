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
    /**
     * route url
     * @var string
     */
    public $route = '';
    
    /**
     * properti untuk set default action
     * @var string //default actionIndex
     */
    private $_defaultAction = 'index';
    
    /**
     * properti untuk set default controller
     * @var string // default 'defaultController'
     */
    private $_defaultController = 'default';
    
    public function __construct() {
        $this->setRequestRoute();
        $this->runAplikasi();
    }
    
    /**
     * method untuk menset request route
     */
    public function setRequestRoute(){
        if (isset($_GET['r'])){
            $this->route = $_GET['r'];
        }
    }
    
    /**
     * method untuk getter request route
     * @return string
     */
    public function getRequestRoute(){
        return $this->route;
    }
    
    /**
     * menjalankan aplikasi 
     * menjalakan controller beserta model dan menset action
     */
    private function runAplikasi(){
        if (!is_null($this->route)){
            $routes = $this->parseRoute();
            $this->setDefaultController($routes['controller']);
            $this->setDefaultAction($routes['action']);
            spl_autoload_register(array($this,'loadModel'));
            $this->runController($this->_defaultController)->getAction($this->_defaultAction);
        }
    }
    
    /**
     * method untuk setter default controller
     * @param string $params default controller yang akan digunakan default null
     */
    public function setDefaultController($params=null){
        
        if (!empty($params)){
            $this->_defaultController = $params;
        }
    }
    
    /**
     * method untuk getter default controller
     * @return string
     */
    public function getDefaultController(){
        return $this->_defaultController;
    }
    
    /**
     * method untuk setter default action
     * @param string $params default action yang akan digunakan default null
     */
    public function setDefaultAction($params=null){
        if (!empty($params)){
            $this->_defaultAction = $params;
        }
    }
    
    /**
     * method untuk getter default action
     * @return string
     */
    public function getDefaultAction(){
        return $this->_defaultAction;
    }
    
    /**
     * method untuk parsing route
     * @return array
     */
    private function parseRoute(){
        $routes = explode('/',$this->route);
        $jumlah = count($routes);

        $controller = $routes[0];
        if ($jumlah == 2){
            $action = $routes[1];
        }

        return array('controller'=>$controller,'action'=>(isset($action) ? $action : ''));
    }
    
    /**
     * method untuk menjalankan controller yang dipanggil
     * @param string $control 
     * @return className nama class dari controller
     */
    public function runController($control){
        include APP_PATH.'kontrol/'.ucfirst(strtolower($control)).'Controller.php';
        $className = ucfirst(strtolower($control)).'Controller';
        return new $className($control);
    }
    
    /**
     * autoloader untuk memanggil kelas model 
     * @param type $classNama berupa nama kelas
     */
    public function loadModel($class){
        if (!is_null($class)){
            include APP_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.ucfirst(strtolower($class)).'.php';
        }
    }
    
    
}

?>
