<?php

// hungarian algorithm taken from https://gist.github.com/iwat/7230798 (modified for speed)
function hungarian($matrix)
{
    $INF = 100000000000;
    $h = count($matrix);
    $w = count($matrix[0]);

    if ($h < $w) {
        for ($i = $h; $i < $w; ++$i) {
            $matrix[$i] = array_fill(0, $w, $INF);
        }
    } elseif ($w < $h) {
        foreach ($matrix as &$row) {
            for ($i = $w; $i < $h; ++$i) {
                $row[$i] =$INF;
            }
        }
    }

    $h = $w = max($h, $w);

    $u = array_fill(0, $h, 0);
    $v = array_fill(0, $w, 0);
    $ind = array_fill(0, $w, -1);

    for ($i = 0; $i < $h; $i++) {
        $links = array_fill(0, $w, -1);
        $mins = array_fill(0, $w, $INF);
        $visited = array_fill(0, $w, false);

        $markedI = $i;
        $markedJ = -1;
        $j = 0;

        while (true) {
            $j = -1;

            for ($j1 = 0; $j1 < $h; $j1++) {
                if (!$visited[$j1]) {
                    $cur = $matrix[$markedI][$j1] - $u[$markedI] - $v[$j1];

                    if ($cur < $mins[$j1]) {
                        $mins[$j1] = $cur;
                        $links[$j1] = $markedJ;
                    }

                    if ($j == -1 || $mins[$j1] < $mins[$j]) {
                        $j = $j1;
                    }
                }
            }

            $delta = $mins[$j];

            for ($j1 = 0; $j1 < $w; $j1++) {
                if ($visited[$j1]) {
                    $u[$ind[$j1]] += $delta;
                    $v[$j1] -= $delta;
                } else {
                    $mins[$j1] -= $delta;
                }
            }

            $u[$i] += $delta;

            $visited[$j] = true;

            $markedJ = $j;
            $markedI = $ind[$j];

            if ($markedI == -1) {
                break;
            }
        }

        while (true) {
            if ($links[$j] != -1) {
                $ind[$j] = $ind[$links[$j]];
                $j = $links[$j];
            } else {
                break;
            }
        }

        $ind[$j] = $i;
    }

    $result = array();

    for ($j = 0; $j < $w; $j++) {
        $result[$j] = $ind[$j];
    }

    return $result;
}

function gcd($x, $y)
{
    while ($x != $y) {
        if ($x > $y) {
            $x = $x - $y;
        } else {
            $y = $y - $x;
        }
    }

    return $x;
}

function vowelsCount($string)
{
    global $cacheVowelsCount;
    if (!isset($cacheVowelsCount[$string])) {
        $cacheVowelsCount[$string] = preg_match_all("/a|e|i|o|u|y|A|E|I|O|U|Y/", $string, $matches);
    }

    return $cacheVowelsCount[$string];
}

function consonantsCount($string)
{
    global $cacheConsonantsCount;
    if (!isset($cacheConsonantsCount[$string])) {
        $regex = "/b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z|B|C|D|F|G|H|J|K|L|M|N|P|Q|R|S|T|V|W|X|Z/";
        $cacheConsonantsCount[$string] = preg_match_all($regex, $string, $matches);
    }

    return $cacheConsonantsCount[$string];
    //return preg_match_all($regex, $string, $matches);
}

function lettersCount($string)
{
    global $cacheLettersCount;
    if (!isset($cacheLettersCount[$string])) {
        $cacheLettersCount[$string] = preg_match_all("/[a-zA-Z]/", $string, $matches);
    }

    return $cacheLettersCount[$string];
}

function ssScore($name, $product)
{
    $score = 0;
    $vowelsCount = vowelsCount($name);
    $nameLettersCount = lettersCount($name);
    $productLettersCount = lettersCount($product);
    if ($productLettersCount % 2 == 0) {
        $score = 1.5 * $vowelsCount;
    } else {
        $consonantsCount = consonantsCount($name);
        $score = $consonantsCount;
    }
    if (gcd($nameLettersCount, $productLettersCount) > 1) {
        $score *= 1.5;
    }

    return $score;
}

$fileName = $argv[1];
$lines = file($fileName);

foreach ($lines as $line) {
    if (!trim($line)) {
        continue;
    }
    list($names, $products) = explode(";", trim($line));
    $names = explode(",", $names);
    $products = explode(",", $products);

    $maxScore = 0;
    $scoresMatrix = array(array());
    for ($i = 0; $i < count($names); $i++) {
        for ($j = 0; $j < count($products); $j++) {
            $score = ssScore($names[$i], $products[$j]);
            $scoresMatrix[$i][$j] = $score;
            if ($score > $maxScore) {
                $maxScore = $score;
            }
        }
    }

    //substract maxScore from scores to create matrix for Hungarian algorithm
    $modifiedScoresMatrix = $scoresMatrix;
    for ($i = 0; $i < count($names); $i++) {
        for ($j = 0; $j < count($products); $j++) {
            $modifiedScoresMatrix[$i][$j] = $maxScore - $modifiedScoresMatrix[$i][$j];
        }
    }

    $pairsSelected = hungarian($modifiedScoresMatrix);

    $resultSet = array();
    $resultScore = 0;
    foreach ($pairsSelected as $j => $i) {
        if (isset($names[$i]) && isset($products[$j])) {
            $resultSet[] = array($names[$i], $products[$j], $scoresMatrix[$i][$j]);
            $resultScore += $scoresMatrix[$i][$j];
        }
    }

    echo sprintf("%.2f", $resultScore)."\n";
}
