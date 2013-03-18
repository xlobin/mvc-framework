<?php
/**
 * Class to manage session function
 */
class CSession {
    
    /**
     * property to see status of session
     * @var array 
     */
    private $_sessionStatus = array(
                    '0'=>'SESSION_DISABLED',
                    '1'=>'SESSION_NONE',
                    '2'=>'SESSION_AKTIF',
                                );

    /**
     * constuctor and start the session
     */
    function __construct() {
        session_start();
    }
    
    /**
     * set session value with name
     * @param string $name
     * @param string $value
     */
    public function setSession($name, $value){
        $_SESSION[$name] = $value;
    }
    
    /**
     * method to get session based on name of session
     * @param string $name name default null
     * @return mixed 
     */
    public function getSession($name=null){
        $result = null;
        if (isset($name)){
            $result = $_SESSION[$name];
        }else{
            $result = $_SESSION;
        }
        return $result;
    }
    
    /**
     * method to get status of session
     * @param boolean $num
     * @return mixed
     */
    public function getStatus($num=true){
        $status = session_status();
        $result = null;
        
        if ($num){
            $result = $status;
        }else if (isset($this->_sessionStatus[$status])){
             $result = $this->_sessionStatus[$status];
        }
        return $result;
    }
    
    /**
     * method to destroy session if exist
     */
    public function destroySession(){
        if ($this->getStatus() == 2){
            session_destroy();
        }
    }
    
    /**
     * method to unset session
     * @param string $name index name of session
     */
    public function unsetSession($name=null){
        if (isset($name)){
            unset($_SESSION[$name]);
        }
        else{
            unset($_SESSION);
        }
    }

}