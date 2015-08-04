<?php
/* The Phockito classes here come from
 * https://github.com/hafriedlander/phockito
 * which uses Mockito as inspiration and Hamcrest for matchers
 */
require_once dirname(__FILE__) . "/../../phockito/Phockito.php";
require_once "../PUnit.php";
class NameGenerator
{

	public function generate()
	{
		return "Justin";
	}
}
class Greeter
{
	private $nameGenerator;

	public function __construct(NameGenerator $nameGenerator)
	{
		$this->nameGenerator = $nameGenerator;
	}

	public function greet()
	{
		$name = $this->nameGenerator->generate();
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
	private $nameGenerator;

	public function setUp()
	{
		Phockito::include_hamcrest();
		$this->nameGenerator = Phockito::mock('NameGenerator');
		$this->testObj = new Greeter($this->nameGenerator);
	}

	public function testGreetNameUsingMockedNameGenerator()
	{
		$name = "Justin";
		Phockito::when($this->nameGenerator)->generate()->return($name);
		$actual = $this->testObj->greet();
		$expected = "Hello, " . $name;
		Test::assertEqual($expected, $actual);
	}

	public function testGreetNameReturnsWorldWhenGeneratorIsBlank()
	{
		Phockito::when($this->nameGenerator)->generate()->return("");
		$actual = $this->testObj->greet();
		$expected = "Hello, World";
		Test::assertEqual($expected, $actual);
	}
}

TestRunner::addTestClass("GreeterTest");
TestRunner::runAllHtml();