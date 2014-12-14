<?php

function bubble($a, $iterationsNumber)
{
    $wereChanges = true;
    $passCounter = 0;
    while ($wereChanges) {
        $wereChanges = false;
        for ($i = 0; $i < count($a) - 1; $i++) {
            if ($a[$i] > $a[$i + 1]) {
                $tmp = $a[$i];
                $a[$i] = $a[$i + 1];
                $a[$i + 1] = $tmp;
                if ($wereChanges == false) {
                    $wereChanges = true;
                };
            }
        }
        $passCounter++;
        if ($iterationsNumber == $passCounter) {
            return $a;
        }
    }

    return $a;
}

$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }

    list($array, $iterationsNumber) = explode(" | ", $line);
    $array = explode(" ", $array);
    $array = array_map(function ($e) {
        return intval($e);
    }, $array);

    echo join(" ", bubble($array, $iterationsNumber))."\n";
}
