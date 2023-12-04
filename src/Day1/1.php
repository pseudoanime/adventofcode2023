<?php
$handle = fopen(__DIR__ . "/input.txt", "r");
$sum=0;
$replacementArray = [
    '/one/' => 'o1e',
    '/two/' => 't2o',
    '/three/' => 't3e',
    '/four/' => 'f4r',
    '/five/' => 'f5e',
    '/six/' => 's6x',
    '/seven/' => 's7n',
    '/eight/' => 'e8t',
    '/nine/' => 'n9e',
    '/zero/' => 'z0o'
];
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $newline = preg_replace(array_keys($replacementArray), $replacementArray, strtolower($line));
        preg_match_all('/\d/', $newline, $matches);
        print_r($matches[0]);
        $first = $matches[0][0];
        $second = sizeof($matches[0]) == 1 ? $first : $matches[0][sizeof($matches[0])-1];
        $num = $first*10+ $second;
        print_r($num . "\n");
        $sum+=$num;

    }
    fclose($handle);
    print_r($sum);
}
