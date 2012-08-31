<?php

/**
 * Class descrição Adapter
 *
 * @author ederson
 */
class TC_Generator_Adapter {

    protected $_package;
    protected $_author = "Éderson Sandre";
    protected $_version = "1.0";
    protected $_class = null;
    protected $_extends = '';
    protected $_path;
    protected $_copyright = "Copyright(c) 2012 Telecontrol Networking <contato@telecontrol.com.br>";

    /*
     * replace "tbl_" to "";
     * @return Zend_Filter_Word_UnderscoreToCamelCase
     */

    public function tableName($table) {
        $filter = new Zend_Filter_Word_UnderscoreToCamelCase();

        return $filter->filter(str_replace('tbl_', '', $table));
    }

    /*
     * @return String 
     */

    public function getExtends() {
        
        if (!empty($this->_extends)) {
            return " extends {$this->_extends}";
        }
    }
    
    /*
     * @params String
     * @return String
     */
    public function setLabel($label){
        
        $dash = new Zend_Filter_Word_UnderscoreToCamelCase();
        $cameCase = new Zend_Filter_Word_CamelCaseToSeparator();
        
        return $cameCase->filter($dash->filter($label));
    }

}

?>
