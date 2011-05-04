

<?php

// SAMPLE FOR METHOD SELECT()

include_once("../generated_classes/class.test.php");

$test = new test();

$test->select(12);

$v = $test->getvorname();

print "$v";

$test->setvorname("alpha");

$v = $test->getvorname();

print "$v";


print "selected record $test->id";

?>