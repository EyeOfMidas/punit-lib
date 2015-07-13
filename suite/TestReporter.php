<?php
class TestReporter
{
	private $debugLog;
	private $testsPass;
	private $testsCalled;
	private $testsFailed;

	public static function getInstance()
	{
		return new TestReporter();
	}

	private function __construct()
	{
		$this->reset();
	}

	public function reset()
	{
		$this->debugLog = array();
		$this->testsPass = true;
		$this->testsCalled = 0;
		$this->testsFailed = 0;
	}

	public function report()
	{
		$output = "";
		if($this->testsPass)
		{
			$output .= "Pass " . $this->testsCalled . "/" . $this->testsCalled . "\n";
		} else {
			$output .= "Pass " . ($this->testsCalled - $this->testsFailed) . "/" . $this->testsCalled. ": Failure: ";
			foreach($this->debugLog as $log)
			{
				$output .= $log;
				$output .= "\n";
			}
		}
		$this->reset();
		return $output;
	}
	
	public function reportHTML()
	{
		$html = '<style type="text/css">'. file_get_contents(SUITE_PATH . "htmlReporter.css") . '</style>'."\n";
		$class = "test-fail";
		if($this->testsPass)
		{
			$class = "test-pass";
		}
		
		$message = $this->report();
		
		return $html . '<div class="' . $class . ' test-result">'."\n\t".
				$message
		."\n</div>\n";
		
	}

	public function logFailure($message)
	{
		$this->testsPass = false;
		$this->debugLog[] = $message;
		$this->testsFailed++;
	}
	
	public function trackTest()
	{
		$this->testsCalled++;
	}
}
