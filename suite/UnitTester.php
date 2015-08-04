<?php
class UnitTester
{

	private static function value_output($data)
	{
		ob_start();
		var_dump($data);
		$a = ob_get_contents();
		ob_end_clean();
		return htmlspecialchars_decode(htmlspecialchars(trim($a), ENT_QUOTES));
	}

	public static function assertEqual($expected, $actual)
	{
		TestReporter::getInstance()->trackTest();
		return UnitTester::_assertEqual($expected, $actual);
	}

	public function assertTrue($actual)
	{
		return TestReporter::getInstance()->assertEqual(true, $actual);
	}

	private static function typesMatch($expected, $actual)
	{
		$expectedType = gettype($expected);
		$actualType = gettype($actual);
		if($expectedType != $actualType)
		{
			TestReporter::getInstance()->logFailure("Expected type was '" . $expectedType . "' but got '" . $actualType . "'");
			return false;
		}
		return true;
	}

	private static function assertArrayEqual($expected, $actual)
	{
		$expectedArrayKeys = array_keys($expected);
		$actualArrayKeys = array_keys($actual);
		if($expectedArrayKeys != $actualArrayKeys)
		{
			$this->reporter->logFailure("Expected keys were " . $this->value_output($expectedArrayKeys) . " but got " . $this->value_output($actualArrayKeys));
			return false;
		}
		
		$equal = true;
		foreach ($expected as $expectedProperty => $expectedValue)
		{
			$equal = UnitTester::_assertEqual($expected[$expectedProperty], $actual[$expectedProperty]);
			if(!$equal)
			{
				return false;
			}
		}
		return true;
	}

	private static function assertObjectEqual($expected, $actual)
	{
		// TODO: compare objects
		return false;
	}

	private static function assertPrimitiveEqual($expected, $actual)
	{
		$result = $expected === $actual;
		if(!$result)
		{
			TestReporter::getInstance()->logFailure("Expected value was " . UnitTester::value_output($expected) . " but got " . UnitTester::value_output($actual));
		}
		return $result;
	}

	private static function _assertEqual($expected, $actual)
	{
		if(!UnitTester::typesMatch($expected, $actual))
		{
			return false;
		}
		if(is_array($expected))
		{
			return UnitTester::assertArrayEqual($expected, $actual);
		}
		elseif(is_object($expected))
		{
			return UnitTester::assertObjectEqual($expected, $actual);
		}
		else
		{
			return UnitTester::assertPrimitiveEqual($expected, $actual);
		}
	}

	public function report()
	{
		echo TestReporter::getInstance()->report();
	}

	public function reportHTML()
	{
		echo TestReporter::getInstance()->reportHTML();
	}

	public function reset()
	{
		TestReporter::getInstance()->reset();
	}
}
