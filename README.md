# Benchmark

Benchmark takes php functions and benchmarks them.


### Installing

This code was tested and run with Xampp. To get this installed, clone the repo to your xampp/htdocs folder.

```
git clone https://github.com/FlyMoe/Benchmark.git
```

### Running

To run the benchmark test open any browser and type:
```
http://localhost/benchmark/index.php
```
In index.php you can add any string or math function to the array along with the counter to see how long it will take to run.

In the $comparator_array you can change the order in which it displays by changing the $order variable. Your options are:
```
// "no"   : no order - default
// "asc"  : ascending order
// "desc" : descending order
```

In the $reporter you can change the output to the screen or disk by changing the $output variable to:
```
// sc : screen - default
// dk : disk as html - saved in the /tmp directory
```

## PHPUnit Testing

Version - PHPUnit 9.0.0 

In your benchmark directory run this command to run the tests.

```
vendor/bin/phpunit tests BookmarkTest.php
```
