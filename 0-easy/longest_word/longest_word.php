<?php
$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }

    $words = explode(" ", $line);
    $longest = "";
    foreach ($words as $word) {
        if (strlen($word) > strlen($longest)) {
            $longest = $word;
        }
    }
    echo $longest."\n";
}
