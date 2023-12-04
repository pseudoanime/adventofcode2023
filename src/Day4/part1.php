<?php
$sum=0;
$handle = fopen(__DIR__ . "/input.txt", "r");

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $numbers = explode("|", $line);
         preg_match_all('/\d+/', explode(":", ($numbers[0]))[1], $matches);
        $winningNumbers = $matches[0];
        preg_match_all('/\d+/', $numbers[1], $matches);
        $scratchCardNumbers = $matches[0];
        $matchingNumbers = array_intersect($winningNumbers, $scratchCardNumbers);
        print_r($matchingNumbers);
        if(!empty($matchingNumbers)) {
            switch (sizeof($matchingNumbers)) {
                case 1:
                    $points = 1;
                    break;
                default:
                    $points = pow(2, sizeof($matchingNumbers)-1);
            }
            $sum+=$points;
        }
    }
}
fclose($handle);
print_r($sum);
