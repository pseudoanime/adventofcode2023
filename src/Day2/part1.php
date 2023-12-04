<?php
$handle = fopen(__DIR__ . "/input.txt", "r");
$max = [
    'blue' => 14,
    'red' => 12,
    'green' => 13
];
$sum=0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $flag = true;
        //$current = array_/zfill_keys(['blue', 'green', 'red'], 0);
        preg_match('/\d+/', $line, $matches);
        $game = $matches[0];
        $line = substr($line, strpos($line, ':') + 1);
        $draws = explode(";", $line);
        foreach ($draws as $draw) {
            preg_match_all('/\d+ \w+/', $draw, $matches);
            foreach ($matches[0] as $singleColour) {
                $singleColour = explode( ' ', $singleColour);
                $colour = $singleColour[1];
                if($singleColour[0] > $max[$colour]){
                    $flag = false;
                    break;
                }
            }
        }
        if($flag==true)
            $sum+=$game;
    }
    fclose($handle);
    print_r($sum);
}
