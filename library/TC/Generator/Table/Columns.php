<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class descrição Columns
 *
 * @author ederson
 */
class TC_Generator_Table_Columns {
    private $_table;
    private $_db;
    
    public function __construct($table) {
        $this->setTable($table);
        
        $this->_db = Zend_Registry::get('db');
    }
    
    public function getTable() {
        return $this->_table;
    }

    public function setTable($table) {
        $this->_table = $table;
    }

    public function render(){
        
        $db = new Zend_Db_Select($this->_db);
        $columns = $db->getAdapter()->describeTable($this->_table);
        
        $data = Array();
        foreach ($columns as $key => $value) {
     
            $data[$key] = array(
                'table' => $value['TABLE_NAME'],
                'name' => $value['COLUMN_NAME'],
                'primary_key' => $value['PRIMARY'],
                'type' => $value['DATA_TYPE'],
                'length' => $value['LENGTH'],
                'required' => $value['NULLABLE']
            );
        }
        
        //echo "<pre>"; print_r($data); exit();
        //echo "<pre>"; print_r($columns); exit();
        //echo "<pre>"; print_r($cols); exit();
        
        return $data;
    }

    
}

?>
