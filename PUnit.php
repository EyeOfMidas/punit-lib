<?php
define("SUITE_PATH", dirname(__FILE__) . "/suite/");

function test_autoloader($classname)
{
	require_once SUITE_PATH . $classname . ".php";
}

spl_autoload_register('test_autoloader');
