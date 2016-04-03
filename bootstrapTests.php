<?php
require_once './loader.php';
header('Content-Type: text/plain');

use test\repository\BasicTestSuite as BasicTestSuite;

// Bootstrapper test suites
$basicTestSuite = new BasicTestSuite();

// Test Runner
echo "\r\n-------------------------------- Test Bootstrapper -----------------------------\r\n\r\n";
echo "[".date('Y-m-d H:i:s')."] ModelInstance_OnStore_CanBeReadFromDatabase\r\n";
echo "[".date('Y-m-d H:i:s')."] " . $basicTestSuite->ModelInstance_OnStore_CanBeReadFromDatabase()->message . "\r\n";
echo "[".date('Y-m-d H:i:s')."] ModelInstance_OnRemove_CannotBeReadFromDatabase\r\n";
echo "[".date('Y-m-d H:i:s')."] " . $basicTestSuite->ModelInstance_OnRemove_CannotBeReadFromDatabase()->message . "\r\n";
echo "[".date('Y-m-d H:i:s')."] ModelInstance_OnUpdate_IsChanged\r\n";
echo "[".date('Y-m-d H:i:s')."] " . $basicTestSuite->ModelInstance_OnUpdate_IsChanged()->message . "\r\n";
echo "\r\n-------------------------------- Test Completed --------------------------------\r\n";