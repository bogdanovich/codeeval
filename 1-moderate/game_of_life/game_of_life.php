<?php

$NEIGHBOURS = array(array(-1, -1), array(-1, 0), array(-1, 1), array(0, -1), array(0, 1), array(1, -1), array(1, 0), array(1, 1));

function lookAround($game, $x, $y)
{
    global $NEIGHBOURS;

    $around = array('alive' => 0, 'dead' => 0);

    foreach ($NEIGHBOURS as $neighbour) {
        if (isset($game[$x + $neighbour[0]][$y + $neighbour[1]])) {
            if ($game[$x + $neighbour[0]][$y + $neighbour[1]] == '*') {
                $around['alive']++;
            } else {
                $around['dead']++;
            }
        }
    }

    return $around;
}

$fileName = $argv[1];
$input = file_get_contents($fileName);
$game = array_map(function ($row) {
    return str_split($row);
}, split("\n", $input));

$height = count($game);
$width = count($game[0]);

for ($time = 0; $time < 10; $time++) {
    $changes = array(array());
    for ($i = 0; $i < $height; $i++) {
        for ($j = 0; $j < $width; $j++) {
            $around = lookAround($game, $i, $j);
            if ($game[$i][$j] == '*') {
                //rules for alive cell
                if ($around['alive'] < 2) {
                    $changes[$i][$j] = '.';
                } elseif ($around['alive'] > 3) {
                    $changes[$i][$j] = '.';
                }
            } else {
                //rules for dead cell
                if ($around['alive'] == 3) {
                    $changes[$i][$j] = '*';
                }
            }
        }
    }

    //apply_changes
    foreach ($changes as $i => $row) {
        foreach ($row as $j => $cell) {
            $game[$i][$j] = $cell;
        }
    }

}

echo join("\n", array_map(function ($e) { return join("", $e); }, $game))."\n";
