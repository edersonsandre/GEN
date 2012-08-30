<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDbConnection() {
        $options = $this->getOption('resources');
        $db_adapter = $options['db']['adapter'];
        $params = $options['db']['params'];

        try {
            $resources = $this->getOption('resources');
            $db = Zend_Db::factory($resources['db']['adapter'], $resources['db']['params']);
            $db->getConnection();

            Zend_Registry::set('db', $db);
        } catch (Zend_Db_Exception $e) {
            print_r($resources['db']);

            exit("Não foi possível realizar a conexão com o banco de dados.");
        }
    }

}

