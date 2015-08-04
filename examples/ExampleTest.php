<?php
require_once(dirname(__FILE__). "/../PUnit.php");

echo "--Tautology--\n";
Test::assertTrue(true);
Test::report();

Test::reset();
echo "--Multi with failure--\n";
Test::assertEqual("abc", "123");
Test::assertEqual(12.3, 12.3);
Test::assertEqual(array("joe", "bloggs"), array("joe", "bloggs"));
Test::report();

Test::reset();
echo "--Deep array failure--\n";
$expected = array("data" => true, "structure" => array("top" => 123, "left" => "abc"));
$actual = array("data" => true, "structure" => array("top" => 123, "left" => "abcde"));
Test::assertEqual($expected, $actual);
Test::report();

Test::reset();
echo "--HTML Report--\n";
$expected = "bananas";
$actual = "bananas";
Test::assertEqual($expected, $actual);
Test::reportHTML();