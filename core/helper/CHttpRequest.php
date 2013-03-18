<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CHttpRequest
 *
 * @author sujana
 */
class CHttpRequest extends CKomponen{
    /**
     * host info
     * @var string 
     */
    private $_hostInfo;
    
    /**
     * to determine if the page is secure
     * @var string 
     */
    private $_securePage;
    
    /**
     * base url
     * @var string 
     */
    private $_baseUrl;
    
    /**
     * metho to get host info
     * @return string
     */
    public function getHostInfo(){
        if ($this->_hostInfo === null){
            $this->setHostInfo();
        }
        return $this->_hostInfo;
    }
    
    /**
     * method to set host info
     */
    public function setHostInfo(){
        $http = ($this->getSecurePage()) ? 'https' : 'http';
        $result = $http.'://';
        if (isset($_SERVER['HTTP_HOST'])){    
            $result .= $_SERVER['HTTP_HOST'];
        }else{
            $result .= $_SERVER['SERVER_NAME'];
        }
        $this->_hostInfo = $result;
    }
    
    /**
     * method to get if page is secure
     * @return boolean
     */
    public function getSecurePage(){
        if ($this->_securePage === null){
            $this->_securePage = $this->setSecurePage();
        }
        return $this->_securePage;
    }
    
    /**
     * method to set if page is secure
     * @return boolean
     */
    public function setSecurePage(){
        return false;
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
     * @param string $value
     */
    public function setBaseUrl($value=null){
        $result = $_SERVER['SCRIPT_NAME'];
        if (!empty($value)){
            $result = $value;
        }
        $this->_baseUrl = $this->getHostInfo().$result;
    }
}

?>
