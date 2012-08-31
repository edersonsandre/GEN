
<?php

    /**
    * Form defined for the table Campanha.
    *
    * @package Application_Form_
    * @author Éderson Sandre
    * @version 1.0
    *
    */
 
    class Application_Form_Oportunidade  extends Zend_Form {

        public function init() {
            $this->setMethod('post')->setAttrib('class', 'Campanha');

                        $this->addElement(
            $this->createElement('hidden', 'oportunidade')
                
        );

        $this->addElement(
            $this->createElement('text', 'usuario')
                ->setLabel('Usuario')
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'empresa_cliente')
                ->setLabel('Empresa Cliente')
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'empresa_sistema')
                ->setLabel('Empresa Sistema')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'ibge')
                ->setLabel('Ibge')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Int())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'titulo')
                ->setLabel('Titulo')
                ->setAttrib("maxlength", 100)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'origem')
                ->setLabel('Origem')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'setor')
                ->setLabel('Setor')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'telefone')
                ->setLabel('Telefone')
                ->setAttrib("maxlength", 15)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 15)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'celular')
                ->setLabel('Celular')
                ->setAttrib("maxlength", 15)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 15)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'fax')
                ->setLabel('Fax')
                ->setAttrib("maxlength", 15)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 15)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'email')
                ->setLabel('Email')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'endereco')
                ->setLabel('Endereco')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'bairro')
                ->setLabel('Bairro')
                ->setAttrib("maxlength", 100)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'cep')
                ->setLabel('Cep')
                ->setAttrib("maxlength", 8)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 8)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'pais')
                ->setLabel('Pais')
                ->setAttrib("maxlength", 2)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 2)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'idioma')
                ->setLabel('Idioma')
                ->setAttrib("maxlength", 2)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_StringLength(array("max" => 2)))
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('textarea', 'obs')
                ->setLabel('Obs')
                ->setRequired(true)
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('text', 'data_cadastro')
                ->setLabel('Data Cadastro')
                ->setValue(date("d/m/Y H:i:s"))
                ->setRequired(true)
                ->addFilter(new Zend_Filter_StringTrim())
        );

        $this->addElement(
            $this->createElement('button', 'submit')
                ->setLabel('Save')
                ->setAttrib('type', 'submit')
        );

            //parent::init();
        }
    }
