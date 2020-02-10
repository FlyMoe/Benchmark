<?php

use PHPUnit\Framework\TestCase;

class BenchmarkTest extends TestCase {

	public function testReturnsBenchmarkArray() {

		require_once 'benchmark.php';

		$benchmark = new BenchmarkFunctions();

		$array = array("string" => array("strlen" => 10000,"addslashes" => 300000,"strtoupper" => 2120000));

		$this->assertIsArray($benchmark->benchmark($array));
	}

	public function testReturnsComparatorArrayOrderOk() {

		require_once 'benchmark.php';

		$benchmark = new BenchmarkFunctions();

		$array = array( 'strlen' => 0.7880010604858398,
						'addslashes' => 0.22189712524414062,
						'strtoupper' => 40.684776067733765,
						'strtolower' => 7.817154169082642,
						'floor' => 0.11120390892028809,
						'abs' => 0.3895151615142822,
						'is_nan' => 0.7102229595184326,
						'sqrt' => 0.35664796829223633,
						'execution_time' => 51.0795259475708
					);

		$order = "ok";

		$this->assertIsArray($benchmark->comparator($array, $order));
	}

	public function testReturnsComparatorArrayOrderAsc() {

		require_once 'benchmark.php';

		$benchmark = new BenchmarkFunctions();

		$array = array( 'strlen' => 0.7880010604858398,
						'addslashes' => 0.22189712524414062,
						'strtoupper' => 40.684776067733765,
						'strtolower' => 7.817154169082642,
						'floor' => 0.11120390892028809,
						'abs' => 0.3895151615142822,
						'is_nan' => 0.7102229595184326,
						'sqrt' => 0.35664796829223633,
						'execution_time' => 51.0795259475708
					);

		$order = "asc";

		$this->assertIsArray($benchmark->comparator($array, $order));
	}

	public function testReturnsComparatorArrayOrderDesc() {

		require_once 'benchmark.php';

		$benchmark = new BenchmarkFunctions();

		$array = array( 'strlen' => 0.7880010604858398,
						'addslashes' => 0.22189712524414062,
						'strtoupper' => 40.684776067733765,
						'strtolower' => 7.817154169082642,
						'floor' => 0.11120390892028809,
						'abs' => 0.3895151615142822,
						'is_nan' => 0.7102229595184326,
						'sqrt' => 0.35664796829223633,
						'execution_time' => 51.0795259475708
					);

		$order = "desc";

		$this->assertIsArray($benchmark->comparator($array, $order));
	}

	public function testReturnsReporterStringWithDK() {

		require_once 'benchmark.php';

		$benchmark = new BenchmarkFunctions();

		$comparator_array = array(  'strlen' => 0.7880010604858398,
								    'addslashes' => 0.22189712524414062,
								    'strtoupper' => 40.684776067733765,
									'strtolower' => 7.817154169082642,
									'floor' => 0.11120390892028809,
									'abs' => 0.3895151615142822,
									'is_nan' => 0.7102229595184326,
									'sqrt' => 0.35664796829223633,
									'execution_time' => 51.0795259475708
								);

		$file_string = $benchmark->reporter($comparator_array, "dk");

		$this->assertTrue($file_string);

	}

	public function testReturnsReporterStringWithSC() {

		require_once 'benchmark.php';

		$benchmark = new BenchmarkFunctions();

		$string = "HTML";

		$comparator_array = array(  'strlen' => 0.7880010604858398,
									'addslashes' => 0.22189712524414062,
									'strtoupper' => 40.684776067733765,
									'strtolower' => 7.817154169082642,
									'floor' => 0.11120390892028809,
									'abs' => 0.3895151615142822,
									'is_nan' => 0.7102229595184326,
									'sqrt' => 0.35664796829223633,
									'execution_time' => 51.0795259475708
								);

		$file_string = $benchmark->reporter($comparator_array, "sc");

		$this->assertTrue($file_string);

	}

}

