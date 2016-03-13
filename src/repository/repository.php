<?php

namespace repository;

use repository\models\Apartment as Apartment;

/**
 * Description of repository
 *
 * @author amelendezi
 */
class Repository {

    var $connection = "mysql:host=localhost;dbname=amerepo;charset=utf8mb4";
    var $username = "amerepouser";
    var $password = "fGP37qjthhAp9RU8";
    var $dbparams = array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);

    function __construct() {        
    }

    public function PushSingle(Apartment $apartment) {
        try {
            // Connect
            $connection = $this->Connect();

            // Build Statement
            $statement = "INSERT INTO apartment (instanceId, name, owner, resident, building_instanceId) VALUES(:instanceId, :name, :owner, :resident, :building_instanceId)";

            // Prepare Statement
            $preparedStatement = $connection->prepare($statement);

            // Bind Parameters
            $preparedStatement->bindParam(':instanceId', $apartment->instanceId);
            $preparedStatement->bindParam(':name', $apartment->name);
            $preparedStatement->bindParam(':owner', $apartment->owner);
            $preparedStatement->bindParam(':resident', $apartment->resident);
            $preparedStatement->bindParam(':building_instanceId', $apartment->building_instanceId);

            // Execute
            $preparedStatement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }           
    
    public function Push(DatastoreObject $do)
    {
        // Connect
        $connect = $this->Connect();
        
        // Build Statement
        $this->BuildInsertStatement($do);
    }
    
    private function BuildInsertStatement(DatastoreObject $do)
    {
        $statement = "INSERT INTO " . $do->tableName . "(";
        $params = $do->params;
        
        for ($i = 0; $i < count($params) - 1; $i++) {
            
            $statement .= $params[i] . ",";
        }
        $statement .= $params[i+1] . ") VALUES(";
        
        for ($i = 0; $i < count($params) - 1; $i++) {
            
            $statement .= ":" . $params[i] . ",";
        }
        $statement .= $params[i+1] . ")";
        return $statement;
    }
    
    private function Connect() {
        return new \PDO($this->connection, $this->username, $this->password, $this->dbparams);
    }
}