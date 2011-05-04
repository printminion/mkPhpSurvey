

<?php

// SAMPLE FOR METHOD INSERT()

include_once("../generated_classes/class.test.php");

$test = new test();
$test->vorname = "str1"; // String
$test->name    = "str2"; // String
$test->jahr    = 1980;   // Number

$test->insert();

print "inserted as record $test->id";

?>