<?php
class TestRunner
{
	private static $collection = array();

	public static function addTestClass($classname)
	{
		TestRunner::$collection[$classname] = array("setUp" => false, "tearDown" => false);
		$methods = get_class_methods($classname);
		if(in_array("setUp", $methods))
		{
			TestRunner::$collection[$classname]['setUp'] = true;
		}
		
		if(in_array("tearDown", $methods))
		{
			TestRunner::$collection[$classname]['tearDown'] = true;
		}
		foreach ($methods as $method)
		{
			if(substr($method, 0, 4) == "test")
			{
				TestRunner::$collection[$classname]['methods'][] = $method;
			}
		}
	}
	
	public static function addTestDirectory($directory, $postfix, $extension)
	{
		$contents = scandir($directory);
		foreach ($contents as $filename)
		{
			if(stristr($filename, $postfix . $extension))
			{
				$classname = str_replace($extension, "", $filename);
				TestRunner::addTestClass($classname);
			}
		}
	}

	public static function runAllHtml()
	{
		foreach (TestRunner::$collection as $classname => $testData)
		{
			$testClass = new $classname();
			echo "<h3>" . $classname . "</h3>\n";
			foreach ($testData["methods"] as $testMethod)
			{
				if($testData['setUp'])
				{
					$testClass->setUp();
				}
				$testClass->$testMethod();
				if($testData['tearDown'])
				{
					$testClass->tearDown();
				}
			}
			Test::reportHTML();
		}
		
		TestRunner::reset();
		Test::end();
	}

	public static function runAll()
	{
		foreach (TestRunner::$collection as $classname => $testData)
		{
			$testClass = new $classname();
			echo $classname . ": ";
			foreach ($testData["methods"] as $testMethod)
			{
				if($testData['setUp'])
				{
					$testClass->setUp();
				}
				$testClass->$testMethod();
				if($testData['tearDown'])
				{
					$testClass->tearDown();
				}
			}
			Test::report();
		}
		
		TestRunner::reset();
		Test::end();
	}

	public static function reset()
	{
		TestRunner::$collection = array();
	}
}