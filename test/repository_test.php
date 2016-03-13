<?php
// Headers
require_once '../src/loader.php';
// header('Content-Type: text/plain');
use repository as R;
use repository\models as M;

// Prepare
$lb = "<br>";
// Test Case Start
echo "Test Case $lb";

echo "Create Apartment Object $lb";
$name = "Apt. 101";
$owner = "Mickey Mouse";
$resident = "Donald Duck";
$building_instanceId = "0000-0000-0000";
$apartment = new M\Apartment($name, $owner, $resident, $building_instanceId);

echo "Push Single Apartment Object $lb";
$repository = new R\Repository();
$repository->PushSingle($apartment);
echo "PushSingle was successful $lb";