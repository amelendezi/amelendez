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

    public function ModelInstance_OnStore_SingleCanBeReadFromDatabase() {

        // Arrange Storable
        $apartment = new Apartment("Apt. 101", "Mickey Mouse", "Donald Duck", "0000-0000-0000");

        // Clear Data
        $this->repositoryAdmin->ClearTable(StorableType::Apartment);

        // Store Object
        $this->repository->Store($apartment);               
        
        // Get Object
        $result = $this->repository->GetSingle(StorableType::Apartment, $this->GetApartmentWhere($apartment));

        // Asserting
        return $this->assert->AreEqual($apartment, $result);
    }
    
    public function ModelInstances_OnStore_MultipleCanBeReadFromDatabase() {
        
        // Arrange Storable
        $buildingInstanceId = "0000-0000-0000";
        $apartment1 = new Apartment("Apt. 101", "Mickey Mouse", "Donald Duck", $buildingInstanceId);
        $apartment2 = new Apartment("Apt. 102", "Mickey Mouse", "Bert & Ernie", $buildingInstanceId);
        $apartment3 = new Apartment("Apt. 103", "Mickey Mouse", "Goofy & Pluto", $buildingInstanceId);

        // Clear Data
        $this->repositoryAdmin->ClearTable(StorableType::Apartment);

        // Store Object
        $this->repository->Store($apartment1);          
        $this->repository->Store($apartment2);
        $this->repository->Store($apartment3);
        
        // Build where
        $where = new Where();
        $where->Equals("building_instanceId", $apartment1->building_instanceId);
        
        // Get Object
        $result = $this->repository->GetMultiple(StorableType::Apartment, $where);

        // Asserting        
        $this->assert->AppendAssertCase($this->assert->AreEqual($result[0], $apartment1));
        $this->assert->AppendAssertCase($this->assert->AreEqual($result[1], $apartment2));
        $this->assert->AppendAssertCase($this->assert->AreEqual($result[2], $apartment3));        
        return $this->assert->cumulativeAssert;
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
        
        // Asserting
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
        
        // Asserting
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
