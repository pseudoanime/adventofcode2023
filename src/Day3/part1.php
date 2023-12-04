<?php
$handle = fopen(__DIR__ . "/input.txt", "r");

$partNumbers = [];
$symbolsArray = [];
if ($handle) {
    $lineNo = 0;
    $previousLine = '';
    $previousSymbols = [];
    while (($line = fgets($handle)) !== false) {
        preg_match_all('/(\d+(?!(\.|\d)|$))|((?<!(\.|\d)|^)\d+)/', $line, $matches);
        if (!empty($matches[0])) {
            $partNumbers = array_merge($partNumbers, $matches[0]);
        }
        preg_match_all('/[^\d\.\s]/', $line, $matches, PREG_OFFSET_CAPTURE);
        $symbols = $matches[0];
        preg_match_all('/(^\d+(?=(\.)))|((?<=\.)\d+(?=\.))|((?<=\.)\d+$)/', $previousLine, $matches, PREG_OFFSET_CAPTURE);
        $numbersFromPerviousLine = $matches[0];
        foreach ($symbols as $symbol) {
            $symbolposition = $symbol[1];
            foreach ($numbersFromPerviousLine as $numbers) {
                $numberpositionArray = [];
                for($i=0;$i<strlen($numbers[0]);$i++) {
                    $numberpositionArray[] = $numbers[1]+$i;
                }
                if (array_intersect($numberpositionArray, [$symbolposition - 1, $symbolposition, $symbolposition + 1])) {
                        $partNumbers[] = $numbers[0];
                }
            }
        }
        if(!empty($previousSymbols)) {
            preg_match_all('/(^\d+(?=(\.)))|((?<=\.)\d+(?=\.))|((?<=\.)\d+$)/', $line, $matches, PREG_OFFSET_CAPTURE);
            $numbersFromCurrentLine = $matches[0];
            foreach ($previousSymbols as $symbol) {
                $symbolposition = $symbol[1];
                foreach ($numbersFromCurrentLine as $numbers) {
                    $numberpositionArray = [];
                    for($i=0;$i<strlen($numbers[0]);$i++) {
                        $numberpositionArray[] = $numbers[1]+$i;
                    }
                    if (array_intersect($numberpositionArray, [$symbolposition - 1, $symbolposition, $symbolposition + 1])) {
                        $partNumbers[] = $numbers[0];
                    }
                }
            }
        }
        $lineNo++;
        $previousLine = $line;
        $previousSymbols = $symbols;
    }
    fclose($handle);
    print_r(array_sum($partNumbers));
}
