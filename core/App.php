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
        'CException'=>'core/helper/CException.php',
        'CAplikasi'=>'core/app/CAplikasi.php',
        'IKontrol'=>'core/web/IKontrol.php',
        'CModel'=>'core/db/CModel.php',
        'CDBConnection'=>'core/db/CDBConnection.php',
        'CDBCriteria'=>'core/db/CDBCriteria.php',
        'CSession'=>'core/web/CSession.php',
        'CInstance'=>'core/web/CInstance.php',
        'CHtml'=>'core/helper/CHtml.php',
        'CUrl'=>'core/helper/CUrl.php',
        'CHttpRequest'=>'core/helper/CHttpRequest.php',
        'CKomponen'=>'core/base/CKomponen.php',
        'CFile'=>'core/helper/CFile.php',
    );
    
    /**
     * run factory
     * @param array $config
     * @return CWeb
     */
    public static function createWeb($config){
        return new CWeb($config);
    }
    
    /**
     * loader untuk memanggil core class
     * @param Object $class
     */
    public static function loader($class){
        if (!empty($class)){
            if (isset(self::$_coreClass[$class])){
                include self::getPathClasses($class);
            }

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
    
    public static function instance($class){
        return new $class;
    }
}

spl_autoload_register(array('App','loader'));

?>
