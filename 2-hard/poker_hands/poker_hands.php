<?php

class Hand
{
    public static $CARD_VALUES = array(
        "2" => 2, "3" => 3, "4" => 4, "5" => 5, "6" => 6, "7" => 7, "8" => 8,
        "9" => 9, "T" => 10, "J" => 11, "Q" => 12, "K" => 13, "A" => 14);
    public static $COMBOS = array(
        "HighCard" => 0, "OnePair"=> 1, "TwoPairs" => 2, "ThreeOfAKind" => 3, "Straight" => 4, "Flush" => 5, "FullHouse" => 6,
        "FourOfAKind" => 7, "StraightFlush" => 8, "RoyalFlush" => 9);

    private $cards = array();
    private $cardRanks = array();
    private $ranksCount = array();
    private $outcome = array();

    public function __construct($cards)
    {
        $this->cards = $cards;
        $this->initCardRanks();
        $this->initCountRanks();
    }

    public function getValue()
    {
        $this->addHighCards()->addPairs()->addThreeOfAKind()->addStraight()->addFlush();
        $this->addFullHouse()->addFourOfAKind()->addStraightAndRoyalFlush();
        //print_r($this->outcome);
        return $this->outcome;
    }

    private function addStraight()
    {
        if ($this->isStraight()) {
            array_unshift($this->outcome, array(Hand::$COMBOS["Straight"], max($this->cardRanks)));
        }

        return $this;
    }

    private function addFlush()
    {
        if ($this->isFlush()) {
            array_unshift($this->outcome, array(Hand::$COMBOS["Flush"], max($this->cardRanks)));
        }

        return $this;
    }

    private function addFullHouse()
    {
        //print_r($this->ranksCount);
        if (isset($this->ranksCount[3]) && isset($this->ranksCount[2])) {
            // full house here
            array_unshift($this->outcome, array(Hand::$COMBOS["FullHouse"], $this->ranksCount[3][0]));
        }

        return $this;
    }

    private function addFourOfAKind()
    {
        if (isset($this->ranksCount[4])) {
            array_unshift($this->outcome, array(Hand::$COMBOS["FourOfAKind"], $this->ranksCount[4][0]));
        }

        return $this;
    }

    private function addStraightAndRoyalFlush()
    {
        $maxRank = max($this->cardRanks);
        if ($this->isStraight() && $this->isFlush()) {
            array_unshift($this->outcome, array(Hand::$COMBOS["StraightFlush"], $maxRank));
            if ($maxRank == Hand::$CARD_VALUES['A']) {
                array_unshift($this->outcome, array(Hand::$COMBOS["RoyalFlush"], $maxRank));
            }
        }

        return $this;
    }

    private function isStraight()
    {
        //print_r($this->cardRanks);
        for ($i = 0; $i < count($this->cardRanks) - 1; $i++) {
            //echo $this->cardRanks[$i]." ".$this->cardRanks[$i + 1]."\n";
            if ($this->cardRanks[$i] != $this->cardRanks[$i + 1] - 1) {
                return false;
            }
        }

        return true;
    }

    private function isFlush()
    {
        for ($i = 0; $i < count($this->cards) - 1; $i++) {
            //echo $this->cards[$i][1]." ".$this->cards[$i + 1][1]."\n";
            if ($this->cards[$i][1] != $this->cards[$i + 1][1]) {
                return false;
            }
        }

        return true;
    }

    private function addThreeOfAKind()
    {
        if (isset($this->ranksCount[3])) {
            array_unshift($this->outcome, array(Hand::$COMBOS["ThreeOfAKind"], $this->ranksCount[3][0]));
        }

        return $this;
    }

    private function addPairs()
    {
        //print_r($this->ranksCount);
        if (isset($this->ranksCount[2])) {
            foreach ($this->ranksCount[2] as $cardRank) {
                array_unshift($this->outcome, array(Hand::$COMBOS["OnePair"], $cardRank));
            }
            if (count($this->ranksCount[2]) > 1) {
                // two pairs here
                array_unshift($this->outcome, array(Hand::$COMBOS["TwoPairs"], max($this->ranksCount[2])));
            }
        }

        return $this;
    }

    private function addHighCards()
    {
        foreach ($this->cardRanks as $cardRank) {
            array_unshift($this->outcome, array(Hand::$COMBOS['HighCard'], $cardRank));
        }

        return $this;
    }

    private function initCardRanks()
    {
        foreach ($this->cards as $card) {
            $this->cardRanks[] = Hand::$CARD_VALUES[$card[0]];
        }
        sort($this->cardRanks);
    }

    private function initCountRanks()
    {
        $countRanks = array();
        foreach ($this->cardRanks as $cardRank) {
            if (!isset($countRanks[$cardRank])) {
                $countRanks[$cardRank] = 0;
            }
            $countRanks[$cardRank]++;
        }
        $result = array();
        foreach ($countRanks as $cardRank => $rankCount) {
            if (!isset($result[$rankCount])) {
                $result[$rankCount] = array();
            }
            $result[$rankCount][] = $cardRank;
        }
        $this->ranksCount = $result;
    }
}

function compareHands($leftHandCards, $rightHandCards)
{
    $leftHand = new Hand($leftHandCards);
    $rightHand = new Hand($rightHandCards);
    $leftValue = $leftHand->getValue();
    $rightValue = $rightHand->getValue();

    // print_r($leftHandCards);
    // print_r($rightHandCards);
    // print_r($leftValue);
    // print_r($rightValue);
    // exit;

    for ($i = 0; $i < count($leftValue) && $i < count($rightValue); $i++) {
        if ($leftValue[$i] > $rightValue[$i]) {
            return "left";
        } elseif ($leftValue[$i] < $rightValue[$i]) {
            return "right";
        } elseif ($leftValue[$i] == $rightValue[$i]) {
            if ($leftValue[$i][0] > $rightValue[$i][0]) {
                return "left";
            } elseif ($leftValue[$i][0] < $rightValue[$i][0]) {
                return "right";
            }
        }
    }

    return "none";
}

$fileName = $argv[1];
//echo file_get_contents($argv[1]);
$lines = file($fileName);

foreach ($lines as $line) {
    $line = trim($line);
    if (!trim($line)) {
        continue;
    }
    $cards = explode(" ", $line);

    echo compareHands(array_slice($cards, 0, 5), array_slice($cards, 5, 10))."\n";
}
