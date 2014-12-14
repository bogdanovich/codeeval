<?php
$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }

    $a = explode($line[0], $line);
    echo (strlen($a[1]) + 1)."\n";
}
