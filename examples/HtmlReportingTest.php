<?php
require_once "../PUnit.php";
class Greeter
{

	function greet($name)
	{
		if(empty($name))
		{
			$name = "World";
		}
		return "Hello, " . $name;
	}
}
class GreeterTest
{
	private $testObj;

	public function setUp()
	{
		$this->testObj = new Greeter();
	}

	public function testGreetUsesNameInHelloMessage()
	{
		$name = "Justin";
		$expected = "Hello, " . $name;
		$actual = $this->testObj->greet($name);
		Test::assertEqual($expected, $actual);
	}

	public function testGreetAddsWorldWhenNameIsNotSpecified()
	{
		$expected = "Hello, World";
		$actual = $this->testObj->greet("");
		Test::assertEqual($expected, $actual);
	}

	public function tearDown()
	{
		unset($this->testObj);
	}
}

TestRunner::addTestClass("GreeterTest");
TestRunner::runAllHtml();