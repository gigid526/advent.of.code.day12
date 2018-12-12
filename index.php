<?php
$input = file(__DIR__ . '/input.txt', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$previousState = substr($input[0], strlen('initial state: '));
$rules = [];
foreach (array_slice($input, 1) as $line) {
	list($pattern, $outcome) = explode(' => ', $line);
	$rules[$pattern] = $outcome;
}
// the first puzzle
$zeroIndex = 0;
echo "0:\t" . $zeroIndex . "\t" . $previousState . PHP_EOL;
for ($generation = 1; $generation <= 1000; ++$generation) {
	$state = '';
	$previousState = '..' . $previousState;
	$zeroIndex -= 2;
	for ($i = -2; $i < strlen($previousState); ++$i) {
		if ($i < 0) {
			$chunk = str_repeat('.', -$i) . substr($previousState, 0, 5 + $i);
		} else {
			$chunk = str_pad(substr($previousState, $i, 5), 5, '.');
		}
		if (isset($rules[$chunk])) {
			$state .= $rules[$chunk];
		} else {
			$state .= '.';
		}
	}
	$start = 0;
	while ($state{$start} === '.') {
		$start++;
		$zeroIndex++;
	}
	$previousState = rtrim(substr($state, $start), '.');
	echo $generation . ":\t" . $zeroIndex . "\t" . $previousState . PHP_EOL;
}
$total = 0;
for ($i = 0; $i < strlen($previousState); ++$i) {
	if ($previousState{$i} === '#') {
		$total += $zeroIndex + $i;
	}
}
echo $total . PHP_EOL;
// the second puzzle
$patternState = '#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#..#.......#..#.....#';
$zeroIndex = 50000000000 - 100;
$total = 0;
for ($i = 0; $i < strlen($patternState); ++$i) {
	if ($patternState{$i} === '#') {
		$total += $zeroIndex + $i;
	}
}
echo $total . PHP_EOL;
