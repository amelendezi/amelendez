<?php

namespace test\repository;

use test\GenericTest as GenericTest;
use src\repository\StorableType as StorableType;
use src\repository\Where as Where;
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
        $result = $this->repository->GetSingle(StorableType::Apartment, $this->GetApartmentWhere($apartment));

        // Temp printing of result
        return $this->assert->AreEqual($apartment, $result);
    }

    public function ModelInstance_OnRemove_CannotBeReadFromDatabase() {

        // Arrange Storable
        $apartment = new Apartment("Apt. 101", "Mickey Mouse", "Donald Duck", "0000-0000-0000");

        // Clear Data
        $this->repositoryAdmin->ClearTable(StorableType::Apartment);

        // Store Object
        $this->repository->Store($apartment);

        // Delete
        $this->repository->Remove($apartment->instanceId, StorableType::Apartment);

        // Get Object
        $result = $this->repository->GetSingle(StorableType::Apartment, $this->GetApartmentWhere($apartment));
        
        return $this->assert->IsNull($result);
    }
    
    public function ModelInstance_OnUpdate_IsChanged(){
            
        // Clear Data
        $this->repositoryAdmin->ClearTable(StorableType::Apartment);
        
        // Arrange Object
        $apartment = new Apartment("Apt. 101", "Mickey Mouse", "Donald Duck", "0000-0000-0000");            
        $this->repository->Store($apartment);

        // Change de the object
        $apartment->name = "Apartment 101";
        $apartment->resident = "Goofy & Pluto";
        
        // Update Object
        $this->repository->Update($apartment);
        
        // Get Object
        $result = $this->repository->GetSingle(StorableType::Apartment, $this->GetApartmentWhere($apartment));
        
        // Assert
        return $this->assert->AreEqual($result, $apartment);
    }
    
    /**
     * Builds instanceId where clause
     * @return Where
     */
    private function GetApartmentWhere($apartment)
    {
        // Build Where
        $where = new Where();
        $where->Equals("instanceId", $apartment->instanceId);
        return $where;
    }
}
