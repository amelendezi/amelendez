<?php

namespace src\repository;

use src\repository\Where as Where;

/**
 * Description of repository
 *
 * @author amelendezi
 */
class Repository {

    protected $connection = "mysql:host=localhost;dbname=amerepo;charset=utf8mb4";
    protected $username = "amerepouser";
    protected $password = "fGP37qjthhAp9RU8";
    protected $dbparams = array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
    private $repositoryHelper;

    function __construct() {
        $this->repositoryHelper = new RepositoryHelper();
    }

    /**
     * Pushes storable object
     * @param \repository\Storable $storable
     */
    public function Store(Storable $storable) {
        try {
            // Connect
            $connection = $this->Connect();

            // Insert statement literal
            $insertStatement = $this->repositoryHelper->GetInsertStatement($storable);

            // Prepare statement
            $preparedStatement = $connection->prepare($insertStatement);

            // Bind the columns to object values
            $this->BindPreparedStatementParameters($storable, $preparedStatement);

            // Execute
            $preparedStatement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Gets single object given where condition
     * @param type $storableType
     * @param $where
     * @return type
     */
    public function GetSingle($storableType, Where $where) {
        try {
            // Connect
            $connection = $this->Connect();

            // Select statement literal
            $sql = "SELECT * FROM $storableType WHERE " . $where->GetStatement();

            // Prepare statement
            $preparedStatement = $connection->prepare($sql);
            
            // Bind where params to prepared statement
            $where->Bind($preparedStatement);

            // Execute & Fetch
            $preparedStatement->execute();
            $result = $preparedStatement->fetchObject();

            // Return
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }       
    
    /**
     * Gets multiple objects given where condition
     * @param type $storableType
     * @param Where $where
     * @return stdClass[]
     */
    public function GetMultiple($storableType, Where $where) {
        try {
            // Connect
            $connection = $this->Connect();

            // Select statement literal
            $sql = "SELECT * FROM $storableType WHERE " . $where->GetStatement();

            // Prepare statement
            $preparedStatement = $connection->prepare($sql);
            
            // Bind where params to prepared statement
            $where->Bind($preparedStatement);

            // Execute & Fetch
            $preparedStatement->execute();            
            $result = $preparedStatement->fetchAll(\PDO::FETCH_OBJ);

            // Return
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Removes object given its instance id.
     * @param type $instanceId
     * @param type $storableType
     */
    public function Remove($instanceId, $storableType) {
        try {
            // Connect
            $connection = $this->Connect();

            // Delete statemenet literal
            $deleteStatement = "DELETE FROM $storableType WHERE instanceId = :instanceId";

            // Prepare statement
            $preparedStatement = $connection->prepare($deleteStatement);
            $preparedStatement->bindParam(":instanceId", $instanceId);

            // Execute & Fetch
            $preparedStatement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Updates object given the storable (changed). Does not update
     * instanceId nor id.
     * @param type $storable
     */
    public function Update($storable) {
        try {
            // Connect
            $connection = $this->Connect();

            // Update statement literal
            $updateStatement = $this->repositoryHelper->GetUpdateStatement($storable);

            // Prepare statement
            $preparedStatement = $connection->prepare($updateStatement);

            // Bind the columns to object values
            $this->BindPreparedStatementParameters($storable, $preparedStatement);

            // Execute
            $preparedStatement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function Connect() {
        return new \PDO($this->connection, $this->username, $this->password, $this->dbparams);
    }

    private function BindPreparedStatementParameters($storable, $preparedStatement) {
        foreach ($storable as $key => $value) {
            if ($key != "id") {
                $preparedStatement->bindParam(":" . $key, $storable->$key);
            }
        }
    }

}
