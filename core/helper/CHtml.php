<?php
class CHtml {

    /**
     * properti to declare what kind of type allowed in input
     * @var array 
     */
    private static $_typeInput = array(
        'text'=>'text',
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
            
            if (isset($options)){
                $options['value'] = $value;
            }
            else{
                $options = array('value'=>$value);
            }
            $result = self::inputTag('text',$options);
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
            $result = self::openTag('input',$options);
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

}