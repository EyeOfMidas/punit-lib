<?php
class UnitTester
{

	public static function getInstance()
	{
		return new UnitTester(TestReporter::getInstance());
	}
	private $reporter;

	private function __construct(TestReporter $reporter)
	{
		$this->reporter = $reporter;
	}

	private function value_output($data)
	{
		ob_start();
		var_dump($data);
		$a = ob_get_contents();
		ob_end_clean();
		return htmlspecialchars_decode(htmlspecialchars(trim($a), ENT_QUOTES));
	}

	public function assertEqual($expected, $actual)
	{
		$this->reporter->trackTest();
		return $this->_assertEqual($expected, $actual);
	}

	private function typesMatch($expected, $actual)
	{
		$expectedType = gettype($expected);
		$actualType = gettype($actual);
		if($expectedType != $actualType)
		{
			$this->reporter->logFailure("Expected type was '" . $expectedType . "' but got '" . $actualType . "'");
			return false;
		}
		return true;
	}

	private function assertArrayEqual($expected, $actual)
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
			$equal = $this->_assertEqual($expected[$expectedProperty], $actual[$expectedProperty]);
			if(!$equal)
			{
				return false;
			}
		}
		return true;
	}

	private function assertObjectEqual($expected, $actual)
	{
		// TODO: compare objects
		return false;
	}

	private function assertPrimitiveEqual($expected, $actual)
	{
		$result = $expected === $actual;
		if(!$result)
		{
			$this->reporter->logFailure("Expected value was " . $this->value_output($expected) . " but got " . $this->value_output($actual));
		}
		return $result;
	}

	private function _assertEqual($expected, $actual)
	{
		if(!$this->typesMatch($expected, $actual))
		{
			return false;
		}
		if(is_array($expected))
		{
			return $this->assertArrayEqual($expected, $actual);
		}
		elseif(is_object($expected))
		{
			return $this->assertObjectEqual($expected, $actual);
		}
		else
		{
			return $this->assertPrimitiveEqual($expected, $actual);
		}
	}

	public function report()
	{
		echo $this->reporter->report();
	}

	public function reportHTML()
	{
		echo $this->reporter->reportHTML();
	}

	public function reset()
	{
		$this->reporter->reset();
	}
}
