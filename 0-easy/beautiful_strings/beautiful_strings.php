<?php

/**
* Challenge description:
* https://www.codeeval.com/open_challenges/83/
*/

$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }
    $line = preg_replace("/[^a-z]/", "", strtolower($line));
    $charsCount = count_chars($line, 1);
    rsort($charsCount);
    $beauty = 26;
    $maxBeauty = 0;
    foreach ($charsCount as $numberOfOccurence) {
        $maxBeauty += $beauty * $numberOfOccurence;
        $beauty--;
    }

    echo $maxBeauty."\n";
}
