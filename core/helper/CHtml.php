<?php
class CHtml {

    /**
     * properti to declare what kind of type allowed in input
     * @var array 
     */
    private static $_typeInput = array(
        'text'=>'text',
        'button'=>'button',
        'submit'=>'submit',
        'reset'=>'reset',
        'checkbox'=>'checkbox',
        'radio'=>'radio',
        'hidden'=>'hidden',
        'password'=>'password'
    );
    
    /**
     * properti to determine type of button
     * @var array 
     */
    private static $_typeButton = array(
        'submit'=>'submit',
        'reset'=>'reset',
        'button'=>'button',
    );

    /**
     * method to generate text field
     * @param string $name
     * @param mixed $value
     * @param array $options
     * @return string
     */
    public static function textField($name, $value, $options=null){
        $result = '';
        if (isset($name) && isset($value)){
            if (!isset($options))
                $options = array();
            if (isset($value))
                $options['value'] = $value;
            if (!isset($options['name']))
                $options['name'] = $name;
            $result = self::inputTag('text',$options);
        }
        return $result;
    }
    
    /**
     * method to create drop down list 
     * @param string $name
     * @param mixed $value
     * @param array $data
     * @param array $options
     * @return string
     */
    public static function dropDownList($name, $value, $data, $options=null){
        $result = '';
        if (isset($name) && (isset($value)) && (isset($data))){
            if (!isset($options['name']))
                $options['name'] = $name;
            $content = $data;
            if (is_array($data)){
                $content = self::listOption($data,$value);
            }
            $result .= self::tag('select',$options,$content,true);
        }
        return $result;
    }
    
    /**
     * method to automatically generate options
     * @param array $data
     * @param mixed $value
     * @return string
     */
    public static function listOption($data,$value=null){
        $result = '';
        if (isset($data) && is_array($data)){
            foreach ($data as $key => $row) {
                $options = array('value'=>$key);
                if (isset($value)){
                    if ($value == $key){
                        if (!isset($options['selected']))
                            $options['selected'] = 'selected';
                    }
                }
                    
                $result .= self::tag('option',$options,$row,true);
            }
        }
        return $result;
    }
    
    /**
     * method to generate automatically open tag
     * @param string $tag
     * @param array $options
     * @return string
     */
    public static function openTag($tag, $options=null){
        $result = '';
        if (isset($tag)){
            if (isset($options) && is_array($options))
                $options = self::renderAttributes($options);
            $result .= '<'.$tag.' '.$options.'>';
        }
        return $result;
    }
    
    /**
     * method to generate automatically close tag
     * @param string $tag
     * @return string
     */
    public static function closeTag($tag){
        $result = '';
        if (isset($tag)){
            $result .= '</'.$tag.'>';
        }
        return $result;
    }
    
    /**
     * method to generate automatically input tag
     * @param string $type
     * @param array $options
     * @return string
     */
    private static function inputTag($type,$options){
        $result = self::openTag('input');
        if (isset($options)){
            if (isset(self::$_typeInput[$type])){
                $options['type']=self::$_typeInput[$type];
            }
            $result = self::tag('input',$options);
        }
        return $result;
    }
    
    /**
     * method to generate attribute of html entities
     * @param array $options
     * @return string
     */
    public static function renderAttributes($options){
        $result = '';
        if (isset($options) && is_array($options)){
            foreach ($options as $key => $option) {
                $result .= ' '.$key.'="'.$option.'"';
            }
        }
        return $result;
    }
    
    /**
     * method to generate tag automatically
     * @param string $tag
     * @param array $options default null
     * @param string $content default null
     * @param boolean $closeTag deafult false
     * @return string
     */
    public static function tag($tag, $options=null, $content = null, $closeTag = false){
        $result = '';
        if (isset($tag)){
            $result .= '<'.$tag.' '.self::renderAttributes($options).'>';
            if (isset($content))
                $result .= $content;
            if ($closeTag){
                $result .= '</'.$tag.'>';
            }
        }
            
        return $result;
    }
    
    /**
     * method to generate html button type automatically
     * @param string $name name of input button
     * @param mixed $value value of input button
     * @param array $options default null
     * @return string
     */
    public static function button($name, $value, $options = null){
        $result = '';
        if (isset($name) && isset($value)){
            if (!isset($options['name']))
                $options['name']=$name;
            if (!isset($options['value']))
                $options['value']=$value;
            $result .= self::inputTag('button', $options);
        }
        return $result;
    }
    
    /**
     * method to generate html button submit type automatically
     * @param string $name name of input button submit
     * @param mixed $value value of input button submit
     * @param array $options default null
     * @return string
     */
    public static function submitButton($name, $value, $options=null){
        $result = '';
        if (isset($name) && isset($value)){
            if (!isset($options['name']))
                $options['name']=$name;
            if (!isset($options['value']))
                $options['value']=$value;
            $result .= self::inputTag('submit', $options);
        }
        return $result;
    }
    
    /**
     * method to generate html button reset type automatically
     * @param string $name name of input button reset
     * @param mixed $value value of input button reset
     * @param array $options default null
     * @return string
     */
    public static function resetButton($name, $value, $options=null){
        $result = '';
        if (isset($name) && isset($value)){
            if (!isset($options['name']))
                $options['name']=$name;
            if (!isset($options['value']))
                $options['value']=$value;
            $result .= self::inputTag('reset', $options);
        }
        return $result;
    }
    
    /**
     * method to generate open tag form automatically
     * @param string $name name of form
     * @param string $action action of form url
     * @param string $method default post
     * @param array $options html attribute of form
     * @return string
     */
    public static function beginForm($name, $action='', $method='post', $options=null){
        $result = '';
        if (isset($name) && isset($method) && isset($action)){
            if (!isset($options['action']))
                $options['action'] = $action;
            if (!isset($options['method']))
                $options['method'] = $method;
            if (!isset($options['name']))
                $options['name'] = $name;
            $result .= self::tag('form', $options);
        }
        return $result;
    }
    
    /**
     * create close tag for from
     * @return string
     */
    public static function endForm(){
        return self::closeTag('form');
    }
    
    /**
     * method to create link automatically
     * @param string $name
     * @param string $url
     * @param array $options
     * @return string
     */
    public static function link($name, $url, $options=NULL){
        $result = '';
        if (isset($name)){
            if (!isset($options['href']))
                $options['href'] = $url;
            if (!isset($options['name']))
                $options['name'] = $name;
            $result = self::tag('a',$options);
        }
        return $result;
        
    }
    
    /**
     * method to generate checkbox input tag automatically
     * @param string $name name of checkbox
     * @param mixed $value value of checkbox
     * @param string $label label of checkbox
     * @param array $options
     * @return string
     */
    public static function checkBox($name, $value, $label='', $options=null){
        $result = '';
        if (isset($name) && (isset($value))){
            if (!isset($options['name']))
                $options['name'] = $name;
            if (!isset($options['value']))
                $options['value'] = $name;
            $result = self::inputTag('checkbox', $options);
            if (!empty($label))
                $result .= $label;
        }
        return $result;
    }
    
    /**
     * method to generate radio button input tag automatically
     * @param string $name name of radio
     * @param mixed $value value of radio
     * @param string $label label of radio
     * @param array $options
     * @return string
     */
    public static function radioButton($name, $value, $label='', $options=null){
        $result = '';
        if (isset($name) && (isset($value))){
            if (!isset($options['name']))
                $options['name'] = $name;
            if (!isset($options['value']))
                $options['value'] = $name;
            $result = self::inputTag('radio', $options);
            if (!empty($label))
                $result .= $label;
        }
        return $result;
    }
    
    /**
     * method to generate text area automatically
     * @param string $name
     * @param mixed $value
     * @param array $options
     * @return string
     */
    public static function textArea($name, $value, $options=null){
        $result = '';
        if (isset($name) && isset($value)){
            if (!isset($options['name']))
                $options['name'] = $name;
            $result = self::tag('textarea', $options, $value, true);
        }
        return $result;
    }
    
    /**
     * method to create html input tag automatically
     * @param string $name
     * @param mixed $value
     * @param array $options
     * @return string
     */
    public static function hiddenField($name, $value, $options=null){
        $result = '';
        if (isset($name) && isset($value)){
            if (!isset($options))
                $options = array();
            if (isset($value))
                $options['value'] = $value;
            if (!isset($options['name']))
                $options['name'] = $name;
            $result = self::inputTag('hidden',$options);
        }
        return $result;
    }
    
    /**
     * method to create password field
     * @param string $name
     * @param mixed $value
     * @param array $options
     * @return string
     */
    public static function passwordField($name, $value, $options=null){
        $result = '';
        if (isset($name) && isset($value)){
            if (!isset($options))
                $options = array();
            if (isset($value))
                $options['value'] = $value;
            if (!isset($options['name']))
                $options['name'] = $name;
            $result = self::inputTag('password',$options);
        }
        return $result;
    }
    
    public static function activeTextField(){
        
    }
    
    public static function activeInputField($model, $attribute, $value, $options=null){
        if ($model instanceof CModel){
            
        }
    }
    
    public static function refresh(){
        
    }
}