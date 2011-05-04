

<?php

// SAMPLE FOR METHOD UPDATE()

include_once("../generated_classes/class.test.php");

$test = new test();
$test->select(16);       // Load from DB first
$test->name    = "strb"; // String
$test->jahr    = 2006;   // Number

$test->update(16);       // update

print "updated record record $test->id";

?>