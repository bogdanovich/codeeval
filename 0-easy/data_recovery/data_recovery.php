<?php

/**
* Challenge description:
* https://www.codeeval.com/open_challenges/140
*/

$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }

    list($words, $indexes) = explode(";", $line);
    $words = explode(" ", $words);
    $indexes = explode(" ", $indexes);

    $map = array();
    $missedWord = "";
    $wordsCount = count($words);
    for ($i = 0; $i < $wordsCount; $i++) {
        if (isset($indexes[$i])) {
            $map[$indexes[$i]] = $words[$i];
        } else {
            $missedWord = $words[$i];
        }
    }
    for ($i = 1; $i < count($words) + 1; $i++) {
        if (!isset($map[$i])) {
            $map[$i] = $missedWord;
        }
    }
    ksort($map);

    echo join(" ", $map)."\n";
}
