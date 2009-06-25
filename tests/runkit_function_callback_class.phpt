--TEST--
runkit_function_set_callback() function with class callback
--SKIPIF--
<?php if(!extension_loaded("runkit") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
class RunkitFunctorCb {
	private $var;
	public function __construct($var) {
		$this->var = $var;
	}

	public function callback($a) {
		echo "Callback: ", $this->var, ": ";
		var_dump($a);
		return $a;
	}

	public static function static_callback($a) {
		echo "Callback: ", __METHOD__, ": ";
		var_dump($a);
		return $a;
	}
}

function runkit_func($a) {
	echo "Original function: ", __FUNCTION__, ": ";
	var_dump($a);
  return $a;
}

$obj = new RunkitFunctorCb('the object');

runkit_func(123);
runkit_function_set_callback('runkit_func', array($obj, 'callback'));
runkit_func(123);
runkit_function_set_callback('runkit_func', array('RunkitFunctorCb', 'static_callback'));
runkit_func(123);
runkit_function_set_callback('runkit_func', 'RunkitFunctorCb::static_callback');
runkit_func(123);
--EXPECT--
Original function: runkit_func: int(123)
Callback: the object: int(123)
Callback: RunkitFunctorCb::static_callback: int(123)
Callback: RunkitFunctorCb::static_callback: int(123)
