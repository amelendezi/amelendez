<?php

namespace repository\models;
/**
 * Description of apartment
 * @author Melcas
 */
class Apartment {
    
    var $id;
    var $instanceId;
    var $name;
    var $owner;
    var $resident;
    var $building_instanceId;
    
    function __construct($name, $owner, $resident, $building_instanceId) {
        $this->instanceId = uniqid();
        $this->name = $name;
        $this->owner = $owner;
        $this->resident = $resident;
        $this->building_instanceId = $building_instanceId;     
    }
}
