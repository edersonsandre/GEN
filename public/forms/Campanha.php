
<?php

    /**
    * Form defined for the table Campanha.
    *
    * @package Application_Form_
    * @author Éderson Sandre
    * @version 1.0
    * @copyright Copyright(c) 2012 Telecontrol Networking <contato@telecontrol.com.br>
    *
    */
 
    class Application_Form_Campanha extends Twitter_Bootstrap_Form_Horizontal {

        public function init() {
            $this->setMethod('post')
                  ->setAttrib('id', 'form-campanha')
                  ->setDescription('Campanha');

                                $this->addElement(
                $this->createElement('hidden', 'campanha')
                    
            );

            $this->addElement(
                $this->createElement('text', 'usuario')
                     ->setLabel('Usuario')
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
                $this->createElement('text', 'modelo')
                     ->setLabel('Modelo')
                     ->setRequired(true)
                     ->addValidator(new Zend_Validate_Int())
                     ->addFilter(new Zend_Filter_StringTrim())
            );

            $this->addElement(
                $this->createElement('text', 'tipo_campanha')
                     ->setLabel('Tipo Campanha')
                     ->setAttrib("maxlength", 100)
                     ->addValidator(new Zend_Validate_StringLength(array("max" => 100)))
                     ->addFilter(new Zend_Filter_StringTrim())
            );

            $this->addElement(
                $this->createElement('text', 'status')
                     ->setLabel('Status')
                     ->setAttrib("maxlength", 50)
                     ->setRequired(true)
                     ->addValidator(new Zend_Validate_StringLength(array("max" => 50)))
                     ->addFilter(new Zend_Filter_StringTrim())
            );

            $this->addElement(
                $this->createElement('text', 'data_inicio')
                     ->setLabel('Data Inicio')
                     ->setValue(date("d/m/Y"))
                     ->addFilter(new Zend_Filter_StringTrim())
            );

            $this->addElement(
                $this->createElement('text', 'data_fim')
                     ->setLabel('Data Fim')
                     ->setValue(date("d/m/Y"))
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
