<?php
require_once(dirname(__FILE__). "/../suite/autoload.php");
$test = UnitTester::getInstance();

echo "--Tautology--\n";
$test->assertTrue(true);
$test->report();

echo "--Multi with failure--\n";
$test->assertEqual("abc", "123");
$test->assertEqual(12.3, 12.3);
$test->assertEqual(array("joe", "bloggs"), array("joe", "bloggs"));
$test->report();

echo "--Deep array failure--\n";
$expected = array("data" => true, "structure" => array("top" => 123, "left" => "abc"));
$actual = array("data" => true, "structure" => array("top" => 123, "left" => "abcde"));
$test->assertEqual($expected, $actual);
$test->report();


echo "--HTML Report--\n";
$expected = "bananas";
$actual = "bananas";
$test->assertEqual($expected, $actual);
$test->reportHTML();