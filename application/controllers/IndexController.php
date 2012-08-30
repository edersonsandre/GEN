<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $form = new Application_Form_Campanha();
        
        $this->view->form = $form;
    }
    
    public function testeAction() {
        $foo = new Zend_CodeGenerator_Php_Class();
        $docblock = new Zend_CodeGenerator_Php_Docblock(array(
                    'shortDescription' => 'Sample generated class',
                    'longDescription' => 'This is a class generated with Zend_CodeGenerator.',
                    'tags' => array(
                        array(
                            'name' => 'version',
                            'description' => '$Rev:$',
                        ),
                        array(
                            'name' => 'license',
                            'description' => 'New BSD',
                        ),
                    ),
                ));
        $foo->setName('Foo')
                ->setDocblock($docblock)
                ->setProperties(array(
                    array(
                        'name' => '_bar',
                        'visibility' => 'protected',
                        'defaultValue' => 'baz',
                    ),
                    array(
                        'name' => 'baz',
                        'visibility' => 'public',
                        'defaultValue' => 'bat',
                    ),
                    array(
                        'name' => 'bat',
                        'const' => true,
                        'defaultValue' => 'foobarbazbat',
                    ),
                ))
                ->setMethods(array(
                    // Method passed as array
                    array(
                        'name' => 'setBar',
                        'parameters' => array(
                            array('name' => 'bar'),
                        ),
                        'body' => '$this->_bar = $bar;' . "\n" . 'return $this;',
                        'docblock' => new Zend_CodeGenerator_Php_Docblock(array(
                            'shortDescription' => 'Set the bar property',
                            'tags' => array(
                                new Zend_CodeGenerator_Php_Docblock_Tag_Param(array(
                                    'paramName' => 'bar',
                                    'datatype' => 'string'
                                )),
                                new Zend_CodeGenerator_Php_Docblock_Tag_Return(array(
                                    'datatype' => 'string',
                                )),
                            ),
                        )),
                    ),
                    // Method passed as concrete instance
                    new Zend_CodeGenerator_Php_Method(array(
                        'name' => 'getBar',
                        'body' => 'return $this->_bar;',
                        'docblock' => new Zend_CodeGenerator_Php_Docblock(array(
                            'shortDescription' => 'Retrieve the bar property',
                            'tags' => array(
                                new Zend_CodeGenerator_Php_Docblock_Tag_Return(array(
                                    'datatype' => 'string|null',
                                )),
                            ),
                        )),
                    )),
                ));

        $file = new Zend_CodeGenerator_Php_File(array(
                    'classes' => array($foo),
                    'docblock' => new Zend_CodeGenerator_Php_Docblock(array(
                        'shortDescription' => 'Foo class file',
                        'tags' => array(
                            array(
                                'name' => 'license',
                                'description' => 'New BSD',
                            ),
                        ),
                    )),
                        //'body' => 'define(\'APPLICATION_ENV\', \'testing\');',
                ));



        $code = $file->generate();

        echo "<pre>";
            print_r($code);
        echo "</pre>";

        file_put_contents('Foo.php', $code);
    }

}

