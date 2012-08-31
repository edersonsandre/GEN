<?php

/**
 * Class descrição Form
 *
 * @author ederson
 */
class TC_Generator_Template_Form extends TC_Generator_Adapter {
    
    
//    protected $_columns;
    public function __construct($table) {
        $this->_class = $this->tableName($table); 
        
        $this->_package = "Application_Form_";
        $this->_path = 'forms/';
        $this->_extends = 'Twitter_Bootstrap_Form_Horizontal';
    }

    public function renderElement(Array $columns) {
        $fields = array();

        foreach ($columns['field'] as $field) { // print_r($field);
            $addedCode = null;
            $fieldType = null;
            $referenceTableClass = null;
            $configs = array();
            $validators = array();
            $filters = array();

            if (!empty($columns['referenceMap'])) {
                foreach ($columns['referenceMap'] as $referenceTable => $reference) {
                    if ($field['name'] === $reference['columns']) {
                        $fieldType = 'select';
                        $referenceTableClass = $reference['refTableClass'];
                        $baseClass = $this->_getCamelCase($reference['table']);
                    }
                }
            }

            if ($field['primary_key']) {
                $fieldType = 'hidden';

                $fieldsConfigs[] = '     ->setAttrib("class", "hidden-input")';
            } elseif ($referenceTableClass) {

                $addedCode = '$table' . $baseClass . ' = new ' . $referenceTableClass . '();';

                //$configs[] = "->setLabel('{$this->setLabel($field['label'])}')";
                $configs[] = '     ->setMultiOptions(array("" => "- - Select - -") + $table' . $baseClass . '->fetchPairs())';

                if ($field['required']) {
                    $configs[] = '     ->setRequired(true)';
                }

                $fieldsConfigs[] = '     ->setAttrib("class", "element-input")';
            } else {
                $configs[] = " ->setLabel('{$this->setLabel($field['name'])}')";

// base on the type and type arguments, add corresponding validators and filters
                switch ($field['type']) {
                    case 'set':
                    case 'enum':
                        /**
                         * For example, ENUM('Male', 'Female') would be converted to
                         *
                         * ->setMultiOptions(array("Male" => "Male", "Female" => "Female"))
                         */
                        $numericOptions = eval("return array($field[type_arguments]);");
                        $assocOptions = array();
                        foreach ($numericOptions as $option) {
                            $option = str_replace("'", "\'", $option);
                            $assocOptions[] = "'$option' => '" . ucfirst($option) . "'";
                        }
                        $array = 'array(' . implode(',', $assocOptions) . ')';
                        $fieldType = 'radio';
                        $configs[] = '     ->setMultiOptions(' . $array . ')';
                        $validators[] = "new Zend_Validate_InArray(array('haystack' => $array))";
                        $configs[] = '     ->setSeparator(" ")';
                        break;
                    case 'tinytext':
                    case 'mediumtext':
                    case 'text':
                    case 'longtext':
                        $fieldType = 'textarea';
                        $filters[] = 'new Zend_Filter_StringTrim()';
                        break;
                    case 'tinyint':
                    case 'mediumint':
                    case 'int':
                    case 'year':
                        $fieldType = 'text';
                        $filters[] = 'new Zend_Filter_StringTrim()';
                        $validators[] = 'new Zend_Validate_Int()';
                        break;
                    case 'decimal':
                    case 'float':
                    case 'double':
                    case 'bigint':
                        $fieldType = 'text';
                        $filters[] = 'new Zend_Filter_StringTrim()';
                        $validators[] = 'new Zend_Validate_Float()';
                        break;
                    case 'varchar':
                    case 'char':
                        $validators[] = 'new Zend_Validate_StringLength(array("max" => ' . $field['length'] . '))';
                        $fieldType = 'text';
                        $filters[] = 'new Zend_Filter_StringTrim()';
                        $configs[] = '     ->setAttrib("maxlength", ' . $field['length'] . ')';

                        if ('email' === strtolower($field['name']) || 'emailaddress' === strtolower($field['name'])) {
                            $validators[] = 'new Zend_Validate_EmailAddress()';
                        }
                        break;
                    case 'bit':
                    case 'date':
                    case 'datetime':
                    case 'time':
                    case 'timestamp':
                    default:
                        $fieldType = 'text';
                        $filters[] = 'new Zend_Filter_StringTrim()';

                        if ('datetime' == $field['type'] || 'timestamp' == $field['type']) {
                            $configs[] = '     ->setValue(date("d/m/Y H:i:s"))';
                        } elseif ('date' == $field['type']) {
                            $configs[] = '     ->setValue(date("d/m/Y"))';
                        } elseif ('time' == $field['type']) {
                            $configs[] = '     ->setValue(date("H:i:s"))';
                        }
                        break;
                }

                if ($field['required']) {
                    $configs[] = '     ->setRequired(true)';
                }

                $fieldsConfigs[] = '     ->setAttrib("class", "element-input")';
            }

//            if ($field['default_value']) {
//                $configs[] = '->setValue("' . str_replace('"', '\"', $field['default_value']) . '")';
//            }

            foreach ($validators as $validator) {
                $configs[] = '     ->addValidator(' . $validator . ')';
            }

            foreach ($filters as $filter) {
                $configs[] = '     ->addFilter(' . $filter . ')';
            }

            $configs = implode("\n                ", $configs);

            $fieldCode = <<<ELEMENT
            \$this->addElement(
                \$this->createElement('$fieldType', '{$field['name']}')
                    $configs
            );
ELEMENT;

            if ($addedCode) {
                $fieldCode = '        ' . $addedCode . "\n" . $fieldCode;
            }

            $fields[] = $fieldCode;
        }

        $buttonDecorators = '';
//
//        if ('Zodeken_Form' === $this->_formBaseClass) {
//            $buttonDecorators = '
//                ->setDecorators($this->buttonDecorators)';
//        }

        $fields[] = <<<CODE
        \$this->addElement(
            \$this->createElement('button', 'submit')
                  ->setLabel('Save')
                  ->setAttrib('type', 'submit')$buttonDecorators
        );
CODE;

        $fields = implode("\n\n", $fields);

        $code = "
<?php

    /**
    * Form defined for the table {$columns['name']}.
    *
    * @package {$this->_package}
    * @author {$this->_author}
    * @version {$this->_version}
    * @copyright {$this->_copyright}
    *
    */
 
    class {$this->_package}{$this->_class}{$this->getExtends()} {

        public function init() {
            \$this->setMethod('post')
                  ->setAttrib('id', 'form-".strtolower($this->_class)."')
                  ->setDescription('{$this->_class}');

                    $fields

            //parent::init();
        }
    }
";

    //echo "<pre>"; exit(print_r($code));

        
        @mkdir($this->_path, 0777);
        $file = $this->_path.$this->_class.".php";
        
        file_put_contents($file, $code);
    }

}
?>

