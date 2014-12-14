<?php
$fileName = $argv[1];
$lines = file($fileName);
$sum = 0;
foreach ($lines as $line) {
    $sum += (int) trim($line);
}
echo $sum."\n";
