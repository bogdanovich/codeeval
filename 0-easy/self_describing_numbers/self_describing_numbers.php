<?php
$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }

    $result = 1;
    for ($i = 0; $i < strlen($line); $i++) {
        $numberOfOccurences = preg_match_all("/".$i."/", $line, $matches);
        if ($line[$i] != $numberOfOccurences) {
            $result = 0;
        }
    }

    echo $result."\n";
}
