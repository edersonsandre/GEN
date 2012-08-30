<?php

/**
 * Class descrição Form
 *
 * @author ederson
 */
class TC_Generator_Template_Form {

//    protected $_columns;
//    public function __construct(Array $columns) {
//        $this->renderElement($columns);
//    }

    public function renderElement(Array $columns) {
        $fields = array();

        foreach ($columns['field'] as $field) {
            $addedCode = null;
            $fieldType = null;
            $referenceTableClass = null;
            $fieldConfigs = array();
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

                $fieldsConfigs[] = '->setAttrib("class", "hidden-input")';
            } elseif ($referenceTableClass) {

                $addedCode = '$table' . $baseClass . ' = new ' . $referenceTableClass . '();';

                $fieldConfigs[] = "->setLabel('$field[label]')";
                $fieldConfigs[] = '->setMultiOptions(array("" => "- - Select - -") + $table' . $baseClass . '->fetchPairs())';

                if ($field['is_required']) {
                    $fieldConfigs[] = '->setRequired(true)';
                }

                $fieldsConfigs[] = '->setAttrib("class", "element-input")';
            } else {
                $fieldConfigs[] = "->setLabel('$field[name]')";

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
                        $fieldConfigs[] = '->setMultiOptions(' . $array . ')';
                        $validators[] = "new Zend_Validate_InArray(array('haystack' => $array))";
                        $fieldConfigs[] = '->setSeparator(" ")';
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
                        $fieldConfigs[] = '->setAttrib("maxlength", ' . $field['length'] . ')';

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
                            $fieldConfigs[] = '->setValue(date("Y-m-d H:i:s"))';
                        } elseif ('date' == $field['type']) {
                            $fieldConfigs[] = '->setValue(date("Y-m-d"))';
                        } elseif ('time' == $field['type']) {
                            $fieldConfigs[] = '->setValue(date("H:i:s"))';
                        }
                        break;
                }

                if ($field['required']) {
                    $fieldConfigs[] = '->setRequired(true)';
                }

                $fieldsConfigs[] = '->setAttrib("class", "element-input")';
            }

//            if ($field['default_value']) {
//                $fieldConfigs[] = '->setValue("' . str_replace('"', '\"', $field['default_value']) . '")';
//            }

            foreach ($validators as $validator) {
                $fieldConfigs[] = '->addValidator(' . $validator . ')';
            }

            foreach ($filters as $filter) {
                $fieldConfigs[] = '->addFilter(' . $filter . ')';
            }

            $fieldConfigs = implode("\n                ", $fieldConfigs);

            $fieldCode = <<<ELEMENT
        \$this->addElement(
            \$this->createElement('$fieldType', '{$field['name']}')
                $fieldConfigs
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
 * Form definido para a tabela {$columns['name']}.
 *
 * @package 
 * @author Éderson Sandre
 * @version \$Id\$
 *
 */
class {$columns['ClassName']} extends Zend_Form
{
    public function init()
    {
        \$this->setMethod('post')->setAttrib('class', '$columns[name]');

            $fields

        parent::init();
    }
}
";

    echo "<pre>"; exit(print_r($code));

        $path = 'forms/';
        @mkdir($path, 0777);
        file_put_contents($path . 'Campanha.php', $code);
    }

}
?>

