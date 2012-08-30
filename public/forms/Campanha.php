
<?php

/**
 * Form definido para a tabela Campanha.
 *
 * @package 
 * @author Éderson Sandre
 * @version $Id$
 *
 */
class Application_Form_Campanha extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post')->setAttrib('class', 'Campanha');

                    $this->addElement(
            $this->createElement('hidden', 'campanha')
                
        );

        $this->addElement(
            $this->createElement('text', 'usuario')
                ->setLabel('usuario')
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'empresa_sistema')
                ->setLabel('empresa_sistema')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'modelo')
                ->setLabel('modelo')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'tipo_campanha')
                ->setLabel('tipo_campanha')
                ->setAttrib("maxlength", 100)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'status')
                ->setLabel('status')
                ->setAttrib("maxlength", 50)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 50)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'data_inicio')
                ->setLabel('data_inicio')
                ->setValue(date("Y-m-d"))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'data_fim')
                ->setLabel('data_fim')
                ->setValue(date("Y-m-d"))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('textarea', 'obs')
                ->setLabel('obs')
                ->setRequired(true)
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'data_cadastro')
                ->setLabel('data_cadastro')
                ->setValue(date("Y-m-d H:i:s"))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('button', 'submit')
                ->setLabel('Save')
                ->setAttrib('type', 'submit')
        );

        parent::init();
    }
}
