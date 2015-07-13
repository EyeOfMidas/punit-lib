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
		}
		else
		{
			$output .= "Pass " . ($this->testsCalled - $this->testsFailed) . "/" . $this->testsCalled . ": Failure: ";
			foreach ($this->debugLog as $log)
			{
				$output .= $log;
				$output .= "\n";
			}
		}
		$this->reset();
		return trim($output) . "\n";
	}

	public function reportHTML()
	{
		$htmlTemplate = file_get_contents(SUITE_PATH . "htmlReportTemplate.html");
		$matches = array();
		preg_match_all("/{{(.+?)}}/i", $htmlTemplate, $matches);
		$uniqueKeys = array_unique($matches[1]);
		
		$class = "test-fail";
		if($this->testsPass)
		{
			$class = "test-pass";
		}
		
		$reportData = array();
		$reportData['successTag'] = "test-pass";
		$reportData['failTag'] = "test-fail";
		$reportData['resultTag'] = $class;
		$reportData['message'] = trim($this->report());
		
		$patterns = array();
		$replacements = array();
		foreach ($uniqueKeys as $index => $key)
		{
			$patterns[] = "/{{" . $key . "}}/i";
			$replacements[] = isset($reportData[$key]) ? $reportData[$key] : "";
		}
		return preg_replace($patterns, $replacements, $htmlTemplate . "\n");
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
