--TEST--
runkit_function_set_callback() function with function callback
--SKIPIF--
<?php if(!extension_loaded("runkit") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
function runkit_func1($a) {
	echo "Original function: ", __FUNCTION__, ": ";
	var_dump($a);
  return $a;
}

function runkit_func2() {
	echo "Original function: ", __FUNCTION__, ": no args\n";
}

function runkit_func_cb1($a) {
	echo "Callback function: ", __FUNCTION__, ": ";
	var_dump($a);
  return $a;
}

function runkit_func_cb2() {
	echo "Cb function: ", __FUNCTION__, ": no args\n";
}

var_dump(runkit_func1(array(1,2, "foo" => 1)));

$f = 'runkit_func_cb1';
var_dump(runkit_function_set_callback('runkit_func1', $f));

var_dump(runkit_func1(array(1,2, "foo" => 1)));

runkit_func2();
var_dump(runkit_function_set_callback('runkit_func2', 'runkit_func_cb2'));
runkit_func2();

?>
--EXPECT--
Original function: runkit_func1: array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  ["foo"]=>
  int(1)
}
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  ["foo"]=>
  int(1)
}
bool(true)
Callback function: runkit_func_cb1: array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  ["foo"]=>
  int(1)
}
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  ["foo"]=>
  int(1)
}
Original function: runkit_func2: no args
bool(true)
Cb function: runkit_func_cb2: no args
