

<?php

// SAMPLE FOR METHOD DELETE()

include_once("../generated_classes/class.test.php");

$test = new test();

$test->select(16);

$test->delete(16);

print "deleted record $test->id";

?>