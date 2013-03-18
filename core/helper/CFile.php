<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CThumbs
 *
 * @author sujana
 */
class CFile extends CKomponen{
    
    /**
     * list of type image date allowed
     * @var array 
     */
    public $typeImage = array('jpg','gif','png');    
    public $typeZip = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/s-compressed');
    
    /**
     * method to filter if files is image or not
     * @param array $files $_FILES
     * @return boolean
     */
    public function filterImage($files){
        $result = false;
        if (isset($files['name'])){
            if(preg_match('/[.](jpg)|(gif)|(png)$/', $files['name'])) {  
                $result = true;
            }  
        }
        return $result;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($value){
        $this->name = $value;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setType($value){
        $this->type = $value;
    }
    
    public function getError(){
        return $this->type;
    }
    
    public function setError($value){
        $this->error = $value;
    }
    
    public function setSize($value){
        $this->size = $value;
    }
    
    public function getTmpName(){
        return $this->tmpName;
    }
    
    public function setTmpName($value){
        $this->tmpName = $value;
    }
    
    /**
     * set value of files
     * @param array $files
     */
    public function setFile($files){
        if (isset($files['name']))
            $this->name = $files['name'];
        if (isset($files['type']))
            $this->type = $files['type'];
        if (isset($files['error']))
            $this->error = $files['error'];
        if (isset($files['size']))
            $this->size = $files['size'];
        if (isset($files['tmp_name']))
            $this->tmpName = $files['tmp_name'];
    }
    
    /**
     * get value of files
     * @param string $properti of image
     * @return mixed
     */
    public function getFile($index=null){
        $result = array(
                    'name'=>$this->name,
                    'type'=>$this->type,
                    'error'=>$this->error,
                    'size'=>$this->size,
                    'tmp_name'=>$this->tmpName,
                );
        if (isset($result[$index])){
            $result = $result[$index];
        }
        
        return $result;
    }
    
    /**
     * upload file to server
     * @param string $target
     * @return boolean
     * @throws Exception
     */
    public function uploadFile($target){
        $result = false;
        if (file_exists($this->tmpName)){
            if (file_exists($target)){
                throw new Exception("File already Exist");
            }else{
                $result = move_uploaded_file($this->tmpName, $target);
            }
        }
        return $result;
    }
    
    /**
     * create thumbs from uploaded images
     * @param string $targetFile path of target file
     * @param string $targetFileThumbs path of target file thumbs
     * @param int $widthThumbs width max of thumbs
     * @return boolean
     */
    public function createThumbsImage($targetFile, $targetFileThumbs, $widthThumbs){
        $im = null;
        $typeFileTarget = substr($targetFile, -5, 5);
        if(preg_match('/[.](jpg)$/', $typeFileTarget)) {  
            $im = imagecreatefromjpeg($targetFile);  
        } else if (preg_match('/[.](gif)$/', $typeFileTarget)) {  
            $im = imagecreatefromgif($targetFile);  
        } else if (preg_match('/[.](png)$/', $typeFileTarget)) {  
            $im = imagecreatefrompng($targetFile);  
        }
        
        $ox = imagesx($im);  
        $oy = imagesy($im);  

        $nx = $widthThumbs;  
        $ny = floor($oy * ($widthThumbs / $ox));  

        $nm = imagecreatetruecolor($nx, $ny);  

        imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);  

        if(!file_exists(dirname($targetFileThumbs))) {  
            if(!mkdir(dirname($targetFileThumbs))) {  
                  die("There was a problem. Please try again!");  
            }   
        }  

        return imagejpeg($nm, $targetFileThumbs);  
    }
    
    /**
     * method to extract zip file
     * @param string $pathToZip
     * @param string $targetToExtract
     */
    public function openZip($pathToZip,$targetToExtract){
        $zip = new ZipArchive();
        $archiveOpen = $zip->open($pathToZip);  
        if($archiveOpen === true) {  
            $zip->extractTo($target);  
            $zip->close();  

            unlink($pathToZip);  
        } else   
            die("There was a problem. Please try again!");  
    }
    
    /**
     * method to get list file in directory
     * @param string $pathFile
     * @return array list of file in directory
     */
    public function getListFile($pathFile){
        if (is_dir($pathFile))
            $scan = $pathFile;
        else
            $scan = dirname($pathFile);
        return scandir($scan);
    }
    
}

?>
