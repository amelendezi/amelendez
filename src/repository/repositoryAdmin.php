<?php

namespace src\repository;

/**
 * Description of repositoryAdmin
 *
 * @author amelendezi
 */
class RepositoryAdmin {
    
    protected $connection = "mysql:host=localhost;dbname=amerepo;charset=utf8mb4";
    protected $username = "amerepouser";
    protected $password = "fGP37qjthhAp9RU8";
    protected $dbparams = array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
    private $repositoryHelper;

    function __construct() {
        $this->repositoryHelper = new RepositoryHelper();
    }
    
    function ClearTable($tableName)
    {
        try {
            // Connect
            $connection = $this->Connect();
            
            // Execute
            $connection->exec("TRUNCATE TABLE " . $tableName);
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function Connect() {
        return new \PDO($this->connection, $this->username, $this->password, $this->dbparams);
    }
}
