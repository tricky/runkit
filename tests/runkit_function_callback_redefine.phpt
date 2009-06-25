--TEST--
runkit_function_set_callback() function with function callback redefined
--SKIPIF--
<?php if(!extension_loaded("runkit") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
function runkit_func($a) {
	echo "Original function: ", __FUNCTION__, ": ";
	var_dump($a);
  return $a;
}

function runkit_func_cb1($a) {
	echo "Callback function: ", __FUNCTION__, ": ";
	var_dump($a);
  return $a;
}

function runkit_func_cb2($a) {
	echo "Callback function: ", __FUNCTION__, ": no args\n";
}

runkit_func(true);
runkit_function_set_callback('runkit_func', 'runkit_func_cb1');
runkit_func(true);
runkit_function_set_callback('runkit_func', 'runkit_func_cb2');
runkit_func(true);

?>
--EXPECT--
Original function: runkit_func: bool(true)
Callback function: runkit_func_cb1: bool(true)
Callback function: runkit_func_cb2: no args
