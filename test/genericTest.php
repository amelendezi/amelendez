<?php

namespace test;

use src\repository\Repository as Repository;
use src\repository\RepositoryAdmin as RepositoryAdmin;

/**
 * Description of GenericTest
 *
 * @author amelendezi
 */
class GenericTest {

    public $repository;
    public $repositoryAdmin; 

    public function __construct() {
        $this->repository = new Repository();
        $this->repositoryAdmin = new RepositoryAdmin();
    }

    public function AssertStorableWithResult($storable, $result) {
        $storableArray = (array) $storable;
        $resultArray = (array) $result;
        foreach ($storableArray as $key => $value) {
            if ($key != "id") {
                if($value != $resultArray[$key])
                {
                    return "FAIL: AssertStorableWithResult finds that $value is different than $resultArray[$key]\r\n";
                }                
            }
        }
        return "AssertStorableWithResult Success\r\n";
    }
}
