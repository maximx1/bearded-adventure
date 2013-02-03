<?php

$tmp = array();

$tmp["a"] = "Justin";
$tmp["b"] = "Timmay";

foreach ($tmp as $key => $value)
{
	print "Key: \t".$key."\n";
	print "value: \t".$value."\n";
}

print $tmp["b"]."\n\n\n\n";

$tmp["meal"]["0"] = 1;
$tmp["meal"]["1"] = 2;
$tmp["meal"]["2"] = 3;
$tmp["meal"]["3"] = 4;
$tmp["meal"]["4"] = 5;
$tmp["meal"]["5"] = 6;
$tmp["meal"]["6"] = 7;
$tmp["meal"]["7"] = 8;
$tmp["meal"]["8"] = 9;
$tmp["meal"]["9"] = 10;

foreach ($tmp["meal"] as $key => $value)
{
	print "Key: \t".$key."\n";
	print "value: \t".$value."\n";
}

$tmp["c"] = "Justin2";
$tmp["d"] = "Timmay2";

foreach ($tmp as $key => $value)
{
	print "Key: \t".$key."\n";
	print "value: \t".$value."\n";
}
?>
