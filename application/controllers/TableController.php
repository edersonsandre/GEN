<?php

class TableController extends TC_Generator_Index {

    public function init() {

        parent::init();
    }

    public function indexAction() {
        $columns =  $this->getColumns()->render();
        
        $form = new TC_Generator_Template_Form();
        
        $data = array(
            'field' => $columns,
            'ClassName' => 'Application_Form_Campanha',
            'name' => 'Campanha'
         );
        
        return $form->renderElement($data);
        
        echo "<pre>";
        echo $form->renderElement($data);
            print_r($form->renderElement($data));
    }

}

