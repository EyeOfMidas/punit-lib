# punit-lib
A very simple PHP Unit test library. Great for quick drop-in testing.

##Including for Use
Copy the suite directory to somewhere your PHP code can include it.
At the top of your test suite file, include the test autoloader.
```PHP
require_once("path/to/punit-lib/PUnit.php");
```

##Creating a test
Create a test file (such as ExampleTest.php)
```PHP
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
```

##Running a test
```bash
php ExampleTest.php
```

Will output
```
--Tautology--
Pass 1/1
--Multi with failure--
Pass 2/3: Failure: Expected value was string(3) "abc" but got string(3) "123"
--Deep array failure--
Pass 0/1: Failure: Expected value was string(3) "abc" but got string(5) "abcde"
--HTML Report--
<style type="text/css">
.test-result {
	padding: 5px;
	margin: 5px;
	color: white;
}

.test-fail {
	background-color: red;
}

.test-pass {
	background-color: green;
}
</style>
<div class="test-pass test-result">
	Pass 1/1
</div>

```
