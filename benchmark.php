<?php


class BenchmarkFunctions {

    public static function benchmark($array) {

	    $execution_time_start = microtime(true);

	 	// Initialize array
		$functions_and_times = array();

		// Turn Unusable constructs into keys with blank values
		$unusable_constructs_array = array_fill_keys(array("echo", "empty", "eval", "exit", "isset", "list", "print", "unset"), '');

		// Loop through the Multidimensional array 
		foreach($array as $functionType => $phpfunctionsArray) {

		    //Remove the Unusable constructs from the php functions array
			$phpfunctionsArray = array_diff_key($phpfunctionsArray, $unusable_constructs_array);

			foreach ($phpfunctionsArray as $function => $count) {

				

				$string = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";

				// Make sure the function is callable
				if (is_callable($function)) {

					// Start the timer
					$time_start = microtime(true);

					for ($i=0; $i < $count; $i++) {

						// If functionType is a string function use the string in the call back,
						// otherwise use an integer
						if ($functionType == "string") {
						    call_user_func_array($function, array($string));
						} else {
							call_user_func_array($function, array($i));
						}

					}

					// End the timer
					$time_end = microtime(true);
					
					// Calculate the time to complete the callback
					$time = $time_end - $time_start;
					
					// Add time and function to array, with the function as the key and time as the value
					$functions_and_times[$function] = $time;
					
				}

			}

		}

		// End execution time
		$execution_time_end = microtime(true);

		// Calculate execution time
		$execution_time = $execution_time_end - $execution_time_start;

		// Add execution time to array
		$functions_and_times['execution_time'] = $execution_time;

		return $functions_and_times;

	}

	public static function comparator($array, $order="no") {

		// Initialize array
		$comparator = array();

		/*************** MIN ***************/
		// Get the key for the minimum value
		$min_key = array_search(min($array), $array);
		// Get the minimum value from array
		$min_value = $array[$min_key];
		// Add min_key and min_value to comparator array
		$comparator['min'] = $min_key.','.$min_value;

		/*************** MAX ***************/
		// set up the execution_time to a temporary variable
		$temp_execution_time = $array['execution_time'];
		// unset execution_time, this is done because if we don't remove it
		// then execution_time will be the max since it will have the biggest time.
		// We add execution_time back later.
		unset($array['execution_time']); 
		// Get the key for the maximum value
		$max_key = array_search(max($array), $array);
		// Get the maximum value from array
		$max_value = $array[$max_key];
		// Add min_key and min_value to comparator array
		$comparator['max'] = $max_key.','.$max_value;
		// Add execution_time back to the array after we get the max.
		$array['execution_time'] = $temp_execution_time;

		/*************** MEAN ***************/
		// Get the mean value from the array
	 	$mean_value = ($max_value + $min_value)/2;
	 	// Add mean comparator array
	 	$comparator['mean'] = $mean_value;

	 	/*************** AVERAGE ***************/
		// Get the average value from the array
	 	$avg_value = array_sum($array)/count($array);
	 	// Add mean comparator array
	 	$comparator['average'] = $avg_value;

	 	// Start of ordering the array by the time
	 	if ($order !== "no") {

	 		// Order array
		 	if (strtolower($order) == "asc") {
		 		//ksort($array);
		 		asort($array);
		 	} elseif (strtolower($order) == "desc") {
		 		//krsort($array);
		 		arsort($array);
		 	}
		}

		// Merge arrays
		$comparator = array_merge($array, $comparator);

        return $comparator;

	}

	public static function reporter($comparatorArray, $output = "sc") {

		// Begin Report
		$line = str_pad("-",38,"-");
		$return = "<pre>$line\n|".str_pad("PHP BENCHMARK",36," ",STR_PAD_BOTH)."|\n$line\nDate : ".date("m-d-Y")."\nTime : ".date("h:i:s a", time())."\n".$line."\n";
		$return .= str_pad("<b>PHP FUNCTIONS</b>", 25) . " : " . "<b>TIMES</b>"."\n";
		foreach ($comparatorArray as $functions => $times) {

			// Execution Time
			if ($functions == "execution_time") {
				$execution_time = $times;
				continue;
			}

			// Minimum
			if ($functions == "min") {
				$min_explode = explode(",", $times);
				$min_function = $min_explode[0];
				$min_time = $min_explode[1];
				continue;
			}

			// Maximum
			if ($functions == "max") {
				$max_explode = explode(",", $times);
				$max_function = $max_explode[0];
				$max_time = $max_explode[1];
				continue;

			}

			// Mean
			if ($functions == "mean") {
				$mean_time = $times;
				continue;
			}

			// Average
			if ($functions == "average") {
				$average_time = $times;
				continue;
			}

			$return .= str_pad("$functions", 18) . " : " . number_format($times, 3) ." sec."."\n";

		}

		// New dotted line
		$return .= $line . "\n";

		if (isset($min_function)) {
			// Report - Total Time result
			$return .= str_pad("Total Time", 18) . " : " . number_format($execution_time, 3) ." sec\n";
		}

		// New dotted line
		$return .= $line."\n";

		// Report - Start of Function Rankings
		$return .= str_pad("<b>Function Rankings</b>", 25)."\n";

		// New dotted line
		$return .= $line."\n";

		if (isset($min_function)) {
			// Report - Min Function result
			$return .= str_pad("<b>Minimum Time</b>", 25)."\n".str_pad("$min_function", 25). " : " . number_format($min_time, 3) ." sec."."\n";
		}

		if (isset($max_function)) {
			// Report - Max Function result
			$return .= str_pad("<b>Maximum Time</b>", 25)."\n".str_pad("$max_function", 25). " : " . number_format($max_time, 3) ." sec."."\n";
		}

		if (isset($mean_time)) {
			// Report - Mean result
			$return .= str_pad("<b>Mean Time</b>", 32). " : " . number_format($mean_time, 3) ." sec."."\n";
		}

		if (isset($average_time)) {
			// Report - Average result
			$return .= str_pad("<b>Average Time</b>", 32). " : " . number_format($average_time, 3) ." sec."."\n$line</pre>";
		}

		if ($output == "dk") {

			// Open file
		    $file = fopen("/tmp/benchmark.html", "w+");

			// If file doesn't open then display error message
			if ($file == false) {
				echo "Error in opening file!";
				exit();
			}

			// Write text to file
			fwrite($file, $return);

			// Close File
			fclose($file);

			echo "HTML file was created!";

			return true;

		} else {

			// Display benchmark
			echo $return;

			return true;

		}

		return false;
	}

}