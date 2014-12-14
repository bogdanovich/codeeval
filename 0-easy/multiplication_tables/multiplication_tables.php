<?php
for ($i = 1; $i <= 12; $i++) {
    for ($j = 1; $j <= 12; $j++) {
        echo sprintf("% 4s", $i * $j);
        if ($j == 12) {
            echo "\n";
        }
    }
}
