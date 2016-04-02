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
    public $assert;

    public function __construct() {
        $this->repository = new Repository();
        $this->repositoryAdmin = new RepositoryAdmin();
        $this->assert = new Assert();
    }    
}
