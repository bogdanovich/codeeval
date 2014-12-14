<?php

function permutations($length, $input)
{
    if ($length == 1) {
        $result = array();
        for ($i = 0; $i < count($input); $i++) {
            $result[$input[$i]] = 1;
        }

        return $result;
    }

    $permutations = permutations($length - 1, $input);
    $result = array();
    for ($i = 0; $i < count($input); $i++) {
        foreach ($permutations as $key => $val) {
            $result[$input[$i].$key] = 1;
        }
    }

    return $result;
}

$fileName = $argv[1];
$lines = file($fileName);
foreach ($lines as $line) {
    list($length, $string) = split(",", trim($line));
    $chars = array_unique(str_split($string));
    sort($chars);
    $permutations = array_keys(permutations($length, $chars));
    sort($permutations);
    echo implode($permutations, ",")."\n";
}
