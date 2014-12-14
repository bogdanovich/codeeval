<?php
$fileName = $argv[1];
$lines = file($fileName);
foreach ($lines as $key => $line) {
    echo strtolower(trim($line))."\n";
}
