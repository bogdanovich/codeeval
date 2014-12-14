<?php
$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }

    list($string, $char) = explode(",", $line);
    $pos = strrpos($string, $char);
    echo ($pos === false) ? "-1" : $pos;
    echo "\n";
}
