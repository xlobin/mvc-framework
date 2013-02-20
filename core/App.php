<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author sujana
 */

define('APP_PATH', dirname(__FILE__).'/../app/');
define('CORE_PATH', dirname(__FILE__));

class App {
    /**
     * list dari class core beserta pathnya
     * @var array
     */
    private static $_coreClass = array(
        'CWeb'=>'core/web/CWeb.php',
        'CKontrol'=>'core/web/CKontrol.php',
        'CAplikasi'=>'core/app/CAplikasi.php',
        'IKontrol'=>'core/web/IKontrol.php',
    );
    
    public static function createWeb($config){
        return new CWeb($config);
    }
    
    /**
     * 
     * @param type $class
     */
    public static function loader($class){
        if (!is_null($class)){
            include self::getPathClasses($class);
        }
    }
    
    /**
     * method untuk mendapatkan path dari kelas core
     * @param string $class
     * @return mixed
     * @throws string
     */
    public static function getPathClasses($class = null){
        $core = self::$_coreClass;
        if (is_null($class)){
            return $core;
        }
        else if (is_array(self::$_coreClass)){
            if (array_key_exists($class, $core)){
                return $core[$class];
            }else{
                throw 'Kelas tidak terdaftar di core class';
            }
        }
    }
    
    /**
     * method untuk mensetting path dari core class
     * @param string $class
     * @param sting $path // berupa path dari class core
     */
    public static function setPathClasses($class, $path){
        if (!is_null(trim($class))){
            self::$_coreClass[$class] = $path;
        }
    }
}

spl_autoload_register(array('App','loader'));

?>
