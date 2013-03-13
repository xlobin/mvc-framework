<?php
class CDBCriteria {

    /**
     * command select
     * @var string default *
     */
    public $select = '*';
    
    /**
     * array untuk tipe command
     * @var array 
     */
    private $_type = array(
        'create'=>'insert',
        'read'=>'select',
        'update'=>'update',
        'delete'=>'delete',
    );
    
    /**
     * command where
     * @var string default empty
     */
    public $where = '';
    
    /**
     * command group
     * @var string deafult empty
     */
    public $group = '';
    
    /**
     * command order
     * @var string default Ascending 
     */
    public $order = 'ASC';
    
    /**
     * command limit
     * @var string default
     */
    public $limit = array();
    
    /**
     * getter select command
     * @return string 
     */
    public function getSelect(){
        return $this->select;
    }
    
    /**
     * setter select command
     * @param mixed $select
     */
    public function setSelect($select){
        $result = '';
        
        /**
         * if string explode into array
         */
        if (is_string($select)){
            $select = explode(',',trim($select));
        }
        
        /**
         * if array implode
         */
        if (is_array($select)){
            $result = implode(', ', $select);
        }
        
        $this->select = $result;
    }
    
    /**
     * seetter untuk kondisional where
     * @param string $params
     */
    public function setWhere($params,$konjungsi){
        if (is_string($params)){
            if (!empty($this->where)){
                $this->where .= ' '.$konjungsi.' '.$params;
            }
            else{
                $this->where .= ' '.$params;
            }
        }
    }
    
    /**
     * getter kondisional
     * @return string kondisional where
     */
    public function getWhere(){
        return $this->where;
    }
    
    /**
     * untuk komparasi field
     * @param string $tableField
     * @param mixed $value
     * @param boolean $operator default false
     * @param sting $konjungsi default and
     */
    public function compare($tableField, $value, $operator = false, $konjungsi = 'and'){
        $result = $tableField;
        if (is_string($value) || (is_integer($value))){
            if (!$operator){
                if (is_integer($value)){
                    $result .= " = ".$value;
                }else{
                    $result .= " = '".$value."'";
                }
            }else if ($operator && (is_string($value))){
                $result .= " ilike '%".$value."%' ";
            }
        }
        
        if (is_array($value)){
            $value = implode(',', $value);
            $result .= ' in('.$value.') ';
        }
        
        $this->setWhere($result,$konjungsi);
    }
    
    /**
     * setter limit condition
     * @param integer $limit
     * @param integer $start start of limit
     */
    public function setLimit($limit,$start){
        if (isset($limit)){
            $this->limit['limit'] = $limit;
        }
        
        if (isset($start)){
            $this->limit['start'] = $start;
        }
    }
    
    /**
     * getter limit condition
     * @return integer
     */
    public function getLimit(){
        return $this->limit;
    }
    
    /**
     * method to create sql command from kriteria
     * @param string $type
     * @param string $table
     * @return string
     */
    public function createCommand($type,$table,$criteria=null){
        $result = '';
        if (isset($this->_type[$type])){
            if ($type == 'read'){
                $result .= $this->_type[$type].' '.$this->select.' from '.$table;
            }
            else if ($type == 'create'){
                $result .= $this->_type[$type]. ' into '.$table.' values ';
            }
            else if ($type == 'delete'){
                $result .= $this->_type[$type].' from '.$table;
            }
            else if ($type == 'update'){
                $result .= $this->_type[$type].' '.$table;
            }
        }
        if (!empty($this->where)){
            $result .= ' where '.$this->where;
        }
        
        if (!empty($this->group)){
            $result .= ' group by '.$this->group;
        }
        
        if (isset($this->limit['limit'])){
            $result .= ' limit '.$this->limit['limit'];
        }
        return $result;
    }

}