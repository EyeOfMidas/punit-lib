<?php
require_once("../suite/autoload.php");
$test = UnitTester::getInstance();

echo "Tautology\n";
$test->assertEqual(true, true);
$test->report();

echo "Multi with failure\n";
$test->assertEqual("abc", "123");
$test->assertEqual(12.3, 12.3);
$test->assertEqual(array("joe", "bloggs"), array("joe", "bloggs"));
$test->report();

