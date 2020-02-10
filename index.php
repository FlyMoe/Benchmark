<?php

require_once 'benchmark.php';

// Multidimensional array of a couple of PHP string and math functions 
// along with the number of times to execute each function
$array = array(
			"string" => array(
					"strlen" => 10000,
					"addslashes" => 300000,
					"echo" => 670000, // Will get removed
					"strtoupper" => 2120000,
					"strtolower" => 400000,
					"strlen" => 1260000
		 )
			,
		  	"math" => array(
		  			"floor" => 200000,
		  			"abs" => 700000,
		  			"is_nan" => 1200000,
		  			"sqrt" => 350000,
		  			"sqrt" => 630000
		  	)
		);
		  	
// Call benchmark
$benchmark_array = Benchmarkfunctions::benchmark($array);

// Order the results in the comparator by the time: 
    // "no"   : no order - default
    // "asc"  : ascending order
    // "desc" : descending order
$order = "no";
$comparator_array = Benchmarkfunctions::comparator($benchmark_array, $order);

// Output to stdout or to disk (html) file
    // sc : screen - default
    // dk : disk as html - saved in the /tmp directory
$output = "sc";
$reporter = Benchmarkfunctions::reporter($comparator_array, $output);