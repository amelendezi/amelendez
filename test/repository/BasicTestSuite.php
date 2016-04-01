<?php

namespace test\repository;

use test\GenericTest as GenericTest;
use src\repository\StorableType as StorableType;
use src\repository\models\Apartment as Apartment;

/**
 * Description of BasicTestSuite
 *
 * @author amelendezi
 */
class BasicTestSuite extends GenericTest {

    public function ModelInstance_OnStore_CanBeReadFromDatabase() {
        
        // Arrange Storable
        $apartment = new Apartment("Apt. 101", "Mickey Mouse", "Donald Duck", "0000-0000-0000");
        
        // Clear Data
        $this->repositoryAdmin->ClearTable(StorableType::Apartment);
        
        // Store Object
        $this->repository->Store($apartment);
        
        // Get Object
        $result = $this->repository->Get($apartment->instanceId, StorableType::Apartment);
        
        // Temp printing of result
        $message = $this->AssertStorableWithResult($apartment, $result);
        
        // Delete
        $this->repository->Remove($result->instanceId, StorableType::Apartment);
        
        return $message;
    }

}
