<?php
class Test
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
		return Test::_assertEqual($expected, $actual);
	}

	public function assertTrue($actual)
	{
		return Test::assertEqual(true, $actual);
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
			$equal = Test::_assertEqual($expected[$expectedProperty], $actual[$expectedProperty]);
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
			TestReporter::getInstance()->logFailure("Expected value was " . Test::value_output($expected) . " but got " . Test::value_output($actual));
		}
		return $result;
	}

	private static function _assertEqual($expected, $actual)
	{
		if(!Test::typesMatch($expected, $actual))
		{
			return false;
		}
		if(is_array($expected))
		{
			return Test::assertArrayEqual($expected, $actual);
		}
		elseif(is_object($expected))
		{
			return Test::assertObjectEqual($expected, $actual);
		}
		else
		{
			return Test::assertPrimitiveEqual($expected, $actual);
		}
	}

	public static function report()
	{
		echo TestReporter::getInstance()->report();
	}

	public static function reportHTML()
	{
		echo TestReporter::getInstance()->reportHTML();
	}

	public static function end()
	{
		$exitCode = TestReporter::getInstance()->exitCode();
		exit($exitCode);
	}
}
