<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CUrl
 *
 * @author sujana
 */
class CUrl extends CKomponen{
    /**
     * properti to declare base url
     * @var string 
     */
    private $_baseUrl;
    
    /**
     * properti to save object CHttpRequest
     * @var object 
     */
    private $_httpRequest;
    
    /**
     * constructor
     */
    public function __construct() {
        $this->_httpRequest = new CHttpRequest();
        $this->setBaseUrl();
    }
    
    /**
     * method to create url
     * @param string $route route of page
     * @param array $params parameter
     * @param string $conjunction default '&'
     * @return string
     */
    public function createUrl($route, $params=array(), $conjunction='&'){
        $result = '';
        if (isset($route)){
            $route = trim($route,'/');
            unset($params['r']);
            $result = $this->createUrlRule($route, $params,$conjunction);
        }
        return $this->_baseUrl.$result;
    }
    
    /**
     * method to get base url
     * @return string
     */
    public function getBaseUrl(){
        return $this->_baseUrl;
    }
    
    /**
     * method to set base url
     */
    public function setBaseUrl(){
        if ($this->_baseUrl === null){
            $this->_httpRequest->setBaseUrl();
        }
        $this->_baseUrl = $this->_httpRequest->getBaseUrl();
    }
    
    /**
     * method to create rule of url
     * @param string $route route of web page
     * @param array $params array of parameter
     * @param string $conjunction konjungsi default '&'
     * @return string
     */
    public function createUrlRule($route, $params=array(), $conjunction='&'){
        $result = '?r=';
        if (isset($route) && is_string($route)){
            $result .= $route;
            if (count($params) > 0){
                foreach ($params as $key => $value) {
                    $result .= $conjunction.$key.'='.$value;
                }
            }
        }
        return $result;
    }
    
}

?>
