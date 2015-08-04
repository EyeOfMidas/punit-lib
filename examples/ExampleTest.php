<?php
require_once "../PUnit.php";

echo "Tautology: ";
Test::assertTrue(true);
Test::report();

echo "Multi with failure: ";
Test::assertEqual("abc", "123");
Test::assertEqual(12.3, 12.3);
Test::assertEqual(array("joe", "bloggs"), array("joe", "bloggs"));
Test::report();

echo "Deep array failure: ";
$expected = array("data" => true, "structure" => array("top" => 123, "left" => "abc"));
$actual = array("data" => true, "structure" => array("top" => 123, "left" => "abcde"));
Test::assertEqual($expected, $actual);
Test::report();