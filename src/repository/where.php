<?php

namespace src\repository;

/**
 * Where clause for prepared statement construction
 *
 * @author amelendezi
 */
class Where {
            
    public $columnName;        
    public $value;       
    public $operator;       
    
    /**
     * Where $columnName = $value
     * @param type $columnName
     * @param type $value
     * @return Where
     */
    public function Equals($columnName, $value)
    {        
        $this->columnName = $columnName;
        $this->value = $value;
        $this->operator = " = ";        
    }      
    
    /**
     * Returns the prepared statement literal
     */
    public function GetStatement()
    {
        return $this->columnName . $this->operator . ":" . $this->columnName;
    }
    
    /**
     * Binds the $columnName with the $value
     * @param type $preparedStatement
     */
    public function Bind($preparedStatement)
    {
        $preparedStatement->bindParam(":" . $this->columnName, $this->value);
    }
}
