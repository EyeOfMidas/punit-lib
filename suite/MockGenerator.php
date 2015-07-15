<?php
class MockGenerator
{

	public static function generate($classname)
	{
		$mockName = $classname . "Mock";
		$classDef = "class $mockName extends $classname {}";
// 		$code = $this->extendClassCode($methods);
// 		return eval("$code return \$code;");
		
		eval($classDef);
	}

// 	private function createClassCode($methods)
// 	{
// 		$implements = '';
// 		$interfaces = $this->reflection->getInterfaces();
// 		if(function_exists('spl_classes'))
// 		{
// 			$interfaces = array_diff($interfaces, array('Traversable'));
// 		}
// 		if(count($interfaces) > 0)
// 		{
// 			$implements = 'implements ' . implode(', ', $interfaces);
// 		}
// 		$code = "class " . $this->mock_class . " extends " . $this->mock_base . " $implements {\n";
// 		$code .= "    function " . $this->mock_class . "() {\n";
// 		$code .= "        \$this->" . $this->mock_base . "();\n";
// 		$code .= "    }\n";
// 		if(in_array('__construct', $this->reflection->getMethods()))
// 		{
// 			$code .= "    function __construct() {\n";
// 			$code .= "        \$this->" . $this->mock_base . "();\n";
// 			$code .= "    }\n";
// 		}
// 		$code .= $this->createHandlerCode($methods);
// 		$code .= "}\n";
// 		return $code;
// 	}
	
// 	private function createHandlerCode($methods)
// 	{
// 		$code = '';
// 		$methods = array_merge($methods, $this->reflection->getMethods());
// 		foreach ($methods as $method) {
// 			if ($this->isConstructor($method)) {
// 				continue;
// 			}
// 			$mock_reflection = new SimpleReflection($this->mock_base);
// 			if (in_array($method, $mock_reflection->getMethods())) {
// 				continue;
// 			}
// 			$code .= "    " . $this->reflection->getSignature($method) . " {\n";
// 			$code .= "        \$args = func_get_args();\n";
// 			$code .= "        \$result = &\$this->invoke(\"$method\", \$args);\n";
// 			$code .= "        return \$result;\n";
// 			$code .= "    }\n";
// 		}
// 		return $code;
// 	}
	
	// $reflection = new ReflectionClass($classname);
}
