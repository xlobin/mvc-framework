<?php
/**
 * class to manage function cookie
 */
class CCookie {
    
    /**
     * method to set cookie
     * @param string $name
     * @param string $value
     * @param time $expire
     * @param type $path
     * @param type $domain
     * @param type $secure
     * @param type $httponly
     */
    public function setCookie($name, $value, $expire, $path = null, $domain = null, $secure = null, $httponly = null){
        if (isset($name,$value,$expire)){
            setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
        }
    }
    
    /**
     * method to get cookie
     * @param string $index
     * @return mixed
     */
    public function getCookie($index=null){
        $result = null;
        if (isset($index)){
            $result = $_COOKIE[$index];
        }else{
            $result = $_COOKIE;    
        }
        return $result;
    }
}
