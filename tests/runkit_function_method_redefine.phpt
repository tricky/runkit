--TEST--
runkit_function_set_callback() function with function method redefined
--SKIPIF--
<?php if(!extension_loaded("runkit") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
class Foo {
	public function test() {
		echo "In Foo::test()\n";
	}
}

class Bar {
	public function test() {
		echo "In Bar::test()\n";
	}
}

$cb1 = new Foo();
$cb2 = new Bar();

var_dump(substr('test', 1, 2));
runkit_function_set_callback('substr', array($cb1, 'test'));
substr('test', 1, 2);
runkit_function_set_callback('substr', array($cb2, 'test'));
substr('test', 1, 2);

?>
--EXPECT--
string(2) "es"
In Foo::test()
In Bar::test()
