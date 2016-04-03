<?php

namespace src\repository;

/**
 * Description of repositoryHelper
 *
 * @author amelendezi
 */
class RepositoryHelper {

    public function GetInsertStatement($storable) {
        // Insert Action
        $action = "INSERT INTO ";

        // Table Name               
        $tableName = $this->GetTableName($storable);

        // Keys & Bindings
        $objectKeys = array();
        $i = 0;
        foreach ($storable as $key => $value) {
            if ($key != "id") { // excludes id
                $objectKeys[$i] = $key;
            }
            $i++;
        }
        $columnNames = " (" . implode(", ", $objectKeys) . ") VALUES(:";
        $columnBindings = implode(", :", $objectKeys) . ")";

        // Glue it and return
        return $action . $tableName . $columnNames . $columnBindings;
    }     
    
    public function GetUpdateStatement($storable) {
        // Update Action
        $action = "UPDATE ";
        
        // Table Name
        $tableName = $this->GetTableName($storable) . " ";
        
        // Keys & Bindings
        $objectKeysAndBindings = array();
        $i = 0;
        foreach ($storable as $key => $value) {
            if ($key != "id" && $key != "instanceId") { // excludes id
                $objectKeysAndBindings[$i] = "$key = :" . $key;
            }
            $i++;
        }
        $columnsAndBindings = "SET " . implode(", ", $objectKeysAndBindings) . " ";
        
        // Where
        $where = "WHERE instanceId = :instanceId";
        
        // Glue it and return
        return $action . $tableName . $columnsAndBindings . $where;
    }
    
    private function GetTableName($storable)
    {       
        $storableReflection = new \ReflectionClass($storable);
        return $storableReflection->getShortName();
    }
}
