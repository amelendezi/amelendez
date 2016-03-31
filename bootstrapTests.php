<?php
require_once './loader.php';
header('Content-Type: text/plain');

use test\repository\BasicTestSuite as BasicTestSuite;

// Bootstrapper test suites
$basicTestSuite = new BasicTestSuite();

// Test Runner
echo "\r\n------------------ Test Bootstrapper ---------------\r\n";
echo "[".date('Y-m-d H:i:s')."] ModelInstance_OnStore_CanBeReadFromDatabase ...\r\n";
echo "[".date('Y-m-d H:i:s')."] " . $basicTestSuite->ModelInstance_OnStore_CanBeReadFromDatabase();
echo "------------------ Test Completed ------------------\r\n";