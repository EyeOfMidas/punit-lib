# punit-lib
A very simple PHP Unit test library. Great for quick drop-in testing.

##Including for Use
Copy the suite directory to somewhere your PHP code can include it.
At the top of your test suite file, include the test autoloader.
```PHP
require_once("path/to/suite/autoload.php");
```

##Running a test
```PHP
<?php
require_once("../suite/autoload.php");
$test = UnitTester::getInstance();
$test->assertEqual(true, true);
$test->report();
```