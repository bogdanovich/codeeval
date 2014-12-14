<?php

function decrypt_message($msg, $wordLength, $lastChar)
{
    $lastCharAscii = ord($lastChar);
    $spaceAscii = ord(" ");
    $difference = $lastCharAscii - $spaceAscii;
    $msg = explode(" ", $msg);

    $repeated = array();
    for ($i = 0; $i < count($msg) - 1; $i++) {
        $msg[$i] = intval($msg[$i]);
        if ($msg[$i] - $msg[$i + 1] == $difference && $msg[$i - $wordLength] == $msg[$i + 1]) {
            $repeated[] = $i;
        }
    }

    if (count($repeated) == 2) {
        $n = $lastCharAscii - $msg[$repeated[0]];
        for ($i = 0; $i < count($msg); $i++) {
            $msg[$i] = chr($msg[$i] + $n);
        }

        return join("", $msg);
    }

}

$fileName = $argv[1];
$content = file_get_contents($fileName);
list($wordLength, $lastChar, $msg) = explode(" | ", $content);
echo decrypt_message($msg, intval($wordLength), $lastChar)."\n";
