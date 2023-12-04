<?php
$handle = fopen(__DIR__ . "/input.txt", "r");
$sum=0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $current = array_fill_keys(['blue', 'green', 'red'], 0);
        preg_match('/\d+/', $line, $matches);
        $game = $matches[0];
        $line = substr($line, strpos($line, ':') + 1);
        $draws = explode(";", $line);
        foreach ($draws as $draw) {
            preg_match_all('/\d+ \w+/', $draw, $matches);
            foreach ($matches[0] as $singleColour) {
                $singleColour = explode( ' ', $singleColour);
                $colour = $singleColour[1];
                if($singleColour[0] > $current[$colour]){
                    $current[$colour]  = $singleColour[0];
                }
            }
        }
        $sum+= $current['green']*$current['blue']*$current['red'];
    }
    fclose($handle);
    print_r($sum);
}
