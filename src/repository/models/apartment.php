<?php

namespace repository\models;

use repository\Storable as Storable;

/**
 * Description of apartment
 * @author amelendezi
 */
class Apartment extends Storable{
    
    public $instanceId;
    public $name;
    public $owner;
    public $resident;
    public $building_instanceId;
    
    function __construct($name, $owner, $resident, $building_instanceId) {
        $this->instanceId = uniqid();
        $this->name = $name;
        $this->owner = $owner;
        $this->resident = $resident;
        $this->building_instanceId = $building_instanceId;     
    }            
}
