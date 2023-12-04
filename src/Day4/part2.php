<?php
$sum = 0;
$handle = fopen(__DIR__ . "/input.txt", "r");
$scratchCards = [];
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $numbers = explode("|", $line);
        $winningCard = explode(":", $numbers[0]);
        preg_match('/\d+/', $winningCard[0], $matches);
        $cardNo = $matches[0];
        if (!array_key_exists($cardNo, $scratchCards)) {
            $scratchCards[$cardNo] = 0;
        }
        preg_match_all('/\d+/', $winningCard[1], $matches);
        $winningNumbers = $matches[0];
        preg_match_all('/\d+/', $numbers[1], $matches);
        $scratchCardNumbers = $matches[0];
        $matchingNumbers = array_intersect($winningNumbers, $scratchCardNumbers);
        for ($j = 0; $j <= $scratchCards[$cardNo]; $j++) {
            for ($i = 1; $i <= sizeof($matchingNumbers); $i++) {
                if (!array_key_exists($cardNo + $i, $scratchCards)) {
                    $scratchCards[$cardNo + $i] = 0;
                }
                $scratchCards[$cardNo + $i]++;
            }
        }
        $scratchCards[$cardNo]++;
    }
}
fclose($handle);
print_r(array_sum($scratchCards));
