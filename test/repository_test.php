<?php
// Headers
require_once '../src/loader.php';
header('Content-type: text/plain');

use repository\Repository as Repository;
use repository\StorableType as StorableType;
use repository\models\Apartment as Apartment;

echo "Prepare \r\n";
$name = "Apt. 101";
$owner = "Mickey Mouse";
$resident = "Donald Duck";
$building_instanceId = "0000-0000-0000";
$apartment = new Apartment($name, $owner, $resident, $building_instanceId);

$repository = new Repository();

echo "Execute Clear \r\n";
$repository->ClearTable("Apartment");

echo "Execute Push \r\n";
$repository->Push($apartment);

echo "Execute Pull \r\n";
$result = $repository->PullByInstanceId($apartment->instanceId, StorableType::Apartment);

echo "Result \r\n";
print_r($result);

echo "\r\nTest Completed \r\n";