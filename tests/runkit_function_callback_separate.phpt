--TEST--
runkit_function_set_callback() function delete callback
--SKIPIF--
<?php if(!extension_loaded("runkit") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
class Deletable {
	public $var;

	public function __construct() {
		echo "Constructed...\n";
	}

	public function __destruct() {
		echo "Destructed...\n";
	}

	public public function substr($a, $b, $c) {
		return $this->var;
	}
}

$cb = new Deletable();
var_dump(substr('test', 1, 2));
var_dump(runkit_function_set_callback('substr', array($cb, 'substr')));
$cb->var = 'ba';
unset($cb);
echo "Should not destruct yet...\n";
var_dump(substr('test', 1, 2));
runkit_function_delete_callback('substr');
var_dump(substr('test', 1, 2));


?>
--EXPECT--
Constructed...
string(2) "es"
bool(true)
Should not destruct yet...
string(2) "ba"
Destructed...
string(2) "es"
