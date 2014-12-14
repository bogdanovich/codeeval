<?php
$fileName = $argv[1];
$lines = file($fileName);
foreach ($lines as $line) {
    $list = split(" ", $line);
    $index = array_pop($list);
    echo $list[count($list) - $index]."\n";
}
