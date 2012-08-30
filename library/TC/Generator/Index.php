<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class descrição Index
 *
 * @author ederson
 */
class TC_Generator_Index extends Zend_Controller_Action {

    private $_table;
    private $_dir;
    private $_type = 'controller';
    private $_columns;

    public function init() {
        $this->setTable($this->_getParam('table', false));

        if (!$this->getTable())
            throw new Exception("Tabela Invalida!");
    }

    public function getDir() {
        return $this->_dir;
    }

    public function setDir($dir) {
        $this->_dir = $dir;
    }

    public function getType() {
        return $this->_type;
    }

    public function setType($type) {
        $this->_type = $type;
    }

    public function getTable() {
        return $this->_table;
    }

    public function setTable($table) {
        $this->_table = $table;
    }
    
    public function getColumns() {
        return new TC_Generator_Table_Columns($this->getTable());
    }



}

?>
