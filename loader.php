<?php
// Defines the global application path
define('APPLICATION_PATH', realpath('.'));

// Define the application paths to load
$paths = array(
  APPLICATION_PATH,
  get_include_path()
);

// Set paths defined in the include path of PHP
set_include_path(implode(PATH_SEPARATOR, $paths));

// Autoload function
function __autoload($className)
{
    $filename = str_replace('\\', '/', $className) . '.php';    
    require_once $filename;
}