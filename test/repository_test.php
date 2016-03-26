<?php
// Headers
require_once '../src/loader.php';
header('Content-type: text/plain');

use repository as R;
use repository\models as M;

echo "Prepare \r\n";
$name = "Apt. 101";
$owner = "Mickey Mouse";
$resident = "Donald Duck";
$building_instanceId = "0000-0000-0000";
$apartment = new M\Apartment($name, $owner, $resident, $building_instanceId);

echo "Execute \r\n";
$repository = new R\Repository();

$repository->PushObject($apartment);
echo "Test Completed \r\n";