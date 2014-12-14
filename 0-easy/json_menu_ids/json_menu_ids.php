<?php
$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }
    $result = json_decode($line);
    $sum = 0;
    foreach ($result->menu->items as $item) {
        if (isset($item->label)) {
            $sum += intval($item->id);
        }
    }
    echo $sum."\n";
}
