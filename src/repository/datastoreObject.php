<?php

namespace repository;

/**
 * Description of datastoreObject
 *
 * @author amelendezi
 */
class DatastoreObject {
    
    var $tableName;
    
    var $params;
    
    function __construct($tableName) {
        $this->tableName = $tableName;
        $this->params = array();
    }
    
    public function AddParameter($param)
    {
        array_push($this->params, $param);
    }
}
