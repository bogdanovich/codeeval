<?php
$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }

    $spaceIndex = null;
    $previousSpaceIndex = null;
    for ($i = 0; $i < strlen($line); $i++) {
        if ($line[$i] == " ") {
            $previousSpaceIndex = $spaceIndex;
            $spaceIndex = $i;
        }
    }

    echo trim(substr($line, $previousSpaceIndex, $spaceIndex - $previousSpaceIndex))."\n";
}
