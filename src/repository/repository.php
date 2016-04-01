<?php

namespace src\repository;

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
            foreach ($storable as $key => $value) {
                if ($key != "id") {
                    $preparedStatement->bindParam(":" . $key, $storable->$key);
                }
            }

            // Execute
            $preparedStatement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Pulls object given its instance id.
     * @param type $instanceId
     * @param type $storableType
     * @return stdClass
     */
    public function Get($instanceId, $storableType) {
        try {
            // Connect
            $connection = $this->Connect();

            // Select statement literal
            $sql = "SELECT * FROM $storableType WHERE instanceId = :instanceId";

            // Prepare statement
            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bindParam(":instanceId", $instanceId);

            // Execute & Fetch
            $preparedStatement->execute();
            $result = $preparedStatement->fetchObject();

            // Return
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function Remove($instanceId, $storableType) {
        try {
            // Connect
            $connection = $this->Connect();

            // Delete statemenet literal
            $sql = "DELETE FROM $storableType WHERE instanceId = :instanceId";

            // Prepare statement
            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bindParam(":instanceId", $instanceId);

            // Execute & Fetch
            $preparedStatement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function Connect() {
        return new \PDO($this->connection, $this->username, $this->password, $this->dbparams);
    }

}
