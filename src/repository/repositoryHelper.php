<?php

namespace repository;

/**
 * Description of repositoryHelper

 * @author amelendezi
 */
class RepositoryHelper {

    public function GetInsertStatement($storable) {
        // Insert Action
        $action = "INSERT INTO ";

        // Table Name       
        $storableReflection = new \ReflectionClass($storable);
        $tableName = $storableReflection->getShortName();

        // Keys & Values
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

    public function GetSelectStatementByInstanceId($storable) {
        // Table Name
        $storableReflection = new \ReflectionClass($storable);
        $tableName = $storableReflection->getShortName();

        // Glue it and return
        return "SELECT name FROM " . $tableName . " WHERE instanceId = :instanceId";
    }

    public function MapToObject($instance, $className) {
        return unserialize(sprintf(
                        'O:%d:"%s"%s', strlen($className), $className, strstr(strstr(serialize($instance), '"'), ':')
        ));
    }
}
