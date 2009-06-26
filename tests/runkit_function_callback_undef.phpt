--TEST--
runkit_function_set_callback() function with callback for an undefined function
--SKIPIF--
<?php if(!extension_loaded("runkit") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
function runkit_func_cb() {
	echo "Cb function: ", __FUNCTION__, ": no args\n";
}

var_dump(function_exists('runkit_func'));
var_dump(runkit_function_set_callback('runkit_func', 'runkit_func_cb'));
var_dump(function_exists('runkit_func'));
runkit_func();
var_dump(runkit_function_delete_callback('runkit_func'));
var_dump(function_exists('runkit_func'));

?>
--EXPECT--
bool(false)
bool(true)
bool(true)
Cb function: runkit_func_cb: no args
bool(true)
bool(false)
