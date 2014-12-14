<?php

function nextNumber($numberString)
{
    $number = str_split($numberString);
    for ($i = 0; $i < count($number); $i++) {
        $number[$i] = intval($number[$i]);
    }
    array_unshift($number, 0);
    $lastIndex = count($number) - 1;

    for ($i = $lastIndex - 1; $i >= 0; $i--) {
        for ($j = $lastIndex; $j > $i; $j--) {
            if ($number[$j] > $number[$i]) {
                //swap them
                $tmp = $number[$j];
                $number[$j] = $number[$i];
                $number[$i] = $tmp;

                //sort ascending all digits from $i + 1 to the end
                $lowerDigits = array_slice($number, $i + 1);
                sort($lowerDigits);
                $higherDigits = array_slice($number, 0, $i + 1);
                $number = array_merge($higherDigits, $lowerDigits);
                if ($number[0] == 0) {
                    array_shift($number);
                }

                return join("", $number);
            }
        }
    }

}

$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    echo nextNumber(trim($line))."\n";
}
