
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
            $this->createElement('hidden', 'oportunidade')
                
        );

        $this->addElement(
            $this->createElement('text', 'usuario')
                ->setLabel('usuario')
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'empresa_cliente')
                ->setLabel('empresa_cliente')
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
            $this->createElement('text', 'ibge')
                ->setLabel('ibge')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'titulo')
                ->setLabel('titulo')
                ->setAttrib("maxlength", 100)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'origem')
                ->setLabel('origem')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'setor')
                ->setLabel('setor')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'telefone')
                ->setLabel('telefone')
                ->setAttrib("maxlength", 15)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 15)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'celular')
                ->setLabel('celular')
                ->setAttrib("maxlength", 15)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 15)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'fax')
                ->setLabel('fax')
                ->setAttrib("maxlength", 15)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 15)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'email')
                ->setLabel('email')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'endereco')
                ->setLabel('endereco')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'bairro')
                ->setLabel('bairro')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'cep')
                ->setLabel('cep')
                ->setAttrib("maxlength", 8)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 8)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'pais')
                ->setLabel('pais')
                ->setAttrib("maxlength", 2)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 2)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'idioma')
                ->setLabel('idioma')
                ->setAttrib("maxlength", 2)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 2)))
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
                ->setRequired(true)
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
