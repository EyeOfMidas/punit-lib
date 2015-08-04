<?php
require_once "../PUnit.php";

echo "--Tautology--\n";
Test::assertTrue(true);
Test::report();

echo "--Multi with failure--\n";
Test::assertEqual("abc", "123");
Test::assertEqual(12.3, 12.3);
Test::assertEqual(array("joe", "bloggs"), array("joe", "bloggs"));
Test::report();

echo "--Deep array failure--\n";
$expected = array("data" => true, "structure" => array("top" => 123, "left" => "abc"));
$actual = array("data" => true, "structure" => array("top" => 123, "left" => "abcde"));
Test::assertEqual($expected, $actual);
Test::report();

echo "--HTML Report--\n";
$expected = "bananas";
$actual = "bananas";
Test::assertEqual($expected, $actual);
Test::reportHTML();