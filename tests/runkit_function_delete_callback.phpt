--TEST--
runkit_function_delete_callback()
--SKIPIF--
<?php if(!extension_loaded("runkit") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
function runkit_func($a) {
	echo "Original function: ", __FUNCTION__, ": ";
	var_dump($a);
  return $a;
}

function runkit_func_cb($a) {
	echo "Callback function: ", __FUNCTION__, ": ";
	var_dump($a);
  return $a;
}

var_dump(runkit_function_delete_callback('runkit_func'));
runkit_func(1);
var_dump(runkit_function_set_callback('runkit_func', 'runkit_func_cb'));
runkit_func(2);
var_dump(runkit_function_set_callback('runkit_func', 'runkit_func_cb'));
runkit_func(3);
var_dump(runkit_function_delete_callback('runkit_func'));
runkit_func(4);
var_dump(runkit_function_set_callback('runkit_func', 'runkit_func_cb'));
runkit_func(5);
var_dump(runkit_function_delete_callback('runkit_func'));
runkit_func(6);

?>
--EXPECT--
bool(false)
Original function: runkit_func: int(1)
bool(true)
Callback function: runkit_func_cb: int(2)
bool(true)
Callback function: runkit_func_cb: int(3)
bool(true)
Original function: runkit_func: int(4)
bool(true)
Callback function: runkit_func_cb: int(5)
bool(true)
Original function: runkit_func: int(6)
