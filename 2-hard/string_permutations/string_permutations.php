<?php

function next_permutation($input)
{
    $last_index = count($input) - 1;

    //looking for first element that is smaller then next one
    for ($i = $last_index - 1; @$input[$i] >= $input[$i + 1]; --$i) {
    }

    //if last permutation
    if ($i == -1) {
        return false;
    }

    //looking for the second element that is bigger than we found before
    for ($j = $last_index; $input[$j] <= $input[$i]; --$j) {
    }

    //swap elements
    $tmp = $input[$j];
    $input[$j] = $input[$i];
    $input[$i] = $tmp;

    //reverse elements in between
    for ($i = $i + 1, $j = $last_index; $i < $j; ++$i, --$j) {
        $tmp = $input[$i];
        $input[$i] = $input[$j];
        $input[$j] = $tmp;

    }

    return $input;
}

$fileName = $argv[1];
$lines = file($fileName);
foreach ($lines as $line) {
    $perm = str_split(trim($line));
    sort($perm);
    $result = "";
    do {
        $result .= join("", $perm).",";
    } while ($perm = next_permutation($perm));
    $result = rtrim($result, ",");
    echo $result."\n";
}
