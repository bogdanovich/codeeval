/*
* Challenge description:
* https://www.codeeval.com/open_challenges/86
*/

var fs  = require("fs");

global.ranks = {
	cardValues: {
		"2": 2, "3": 3, "4": 4, "5": 5, "6": 6, "7": 7, "8": 8, 
		"9": 9, "T": 10, "J": 11, "Q": 12, "K": 13, "A": 14,
	},

	combos: {
		"HighCard": 0, "OnePair": 1, "TwoPairs": 2, "ThreeOfAKind": 3, "Straight": 4, "Flush": 5, "FullHouse": 6,
		"FourOfAKind": 7, "StraightFlush": 8, "RoyalFlush": 9 
	}
}

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        cards = line.split(" ");
        console.log(compareHands(cards.slice(0, 5), cards.slice(5, 10)));
    }
});

function compareHands (leftHandCards, rightHandCards) {
	leftHand = new Hand(leftHandCards);
	rightHand = new Hand(rightHandCards);
	
	var valueLeft  = leftHand.getValue();
	var valueRight = rightHand.getValue();

	for(i = 0; i < valueLeft.length && i < valueRight.length; i++) {
		if (valueLeft[i][0] > valueRight[i][0]) {
			return 'left';
		} else if (valueLeft[i][0] < valueRight[i][0]) {
			return 'right';
		} else if (valueLeft[i][0] == valueRight[i][0]) {
			if (valueLeft[i][1] > valueRight[i][1]) {
				return 'left';
			} else if (valueLeft[i][1] < valueRight[i][1]) {
				return 'right';
			}
		}
	}

	return "none";
}

function Hand (cards) {
	this.cards = cards;
	this.outcome = [];

	this.getSortedCardValues = function () {
		var values = [];
		var cardsNum = this.cards.length;
		for (var i = 0; i < cardsNum; i++) {
			values.push(global.ranks.cardValues[this.cards[i][0]]);
		}
		return values.sort(function (a, b) { return a - b});
	}

	this.countRanks = function () {
		var cardsNum = this.cards.length;
		var rankCount = {};
		for (var i = 0; i < cardsNum; i++) {
			if (rankCount[this.cardRanks[i]]) {
				rankCount[this.cardRanks[i]] += 1;	
			} else {
				rankCount[this.cardRanks[i]] = 1;
			}
		}
		var result = {};
		for (var key in rankCount) {
			if (result[rankCount[key]]) {
				result[rankCount[key]].push(parseInt(key));
			} else {
				result[rankCount[key]] = [parseInt(key)];
			}
		}
		return result;
	}

	this.cardRanks = this.getSortedCardValues();
	this.cardSuits = this.cards.map(function (n) {return n[1];});
	this.ranksByCount = this.countRanks();
	
	this.getValue = function () {
		this.addHighCards().addPairs().addThreeOfAKind().addStraight().addFlush();
		this.addFullHouse().addFourOfAKind().addStraightAndRoyalFlush();
		return this.outcome;
	}
		
	// addRoyalFlush defined below
	// addStraightFlush defined below

	this.addFourOfAKind = function () {
		if (this.ranksByCount[4]) {
			this.outcome.unshift([global.ranks.combos.FourOfAKind, this.ranksByCount[4][0]]);
		}		

		return this;
	}

	this.addFullHouse = function () {
		if (this.ranksByCount[2] && this.ranksByCount[3]) {
			this.outcome.unshift([global.ranks.combos.FullHouse, this.ranksByCount[3][0]]);
		}
		
		return this;
	}

	this.isFlush = function () {
		var cardsNum = this.cards.length;
		for (var i = 0; i < cardsNum - 1; i++) {
			if (this.cardSuits[i] !== this.cardSuits[i + 1]) {
				return false;
			}
		}
		return true;
	}

	this.addFlush = function () {
		if (this.isFlush()) {
			this.outcome.unshift([global.ranks.combos.Flush, Math.max.apply(Math, this.cardRanks)]);	
		}
		return this;
	}

	this.isStraight = function () {
		var cardsNum = this.cards.length;
		for (var i = 0; i < cardsNum - 1; i++) {
			if (this.cardRanks[i] !== this.cardRanks[i + 1] - 1) {
				return false;
			}
		}
		return true;
	}

	this.addStraight = function () {
		if (this.isStraight()) {
			this.outcome.unshift([global.ranks.combos.Straight, Math.max.apply(Math, this.cardRanks)]);	
		}
		return this;
	}

	this.addStraightAndRoyalFlush = function () {
		if (this.isFlush() && this.isStraight()) {
			var maxRank = Math.max.apply(Math, this.cardRanks);
			this.outcome.unshift([global.ranks.combos.StraightFlush, maxRank]);		
			if (maxRank == global.ranks.cardValues['A']) {
				// royal flush
				this.outcome.unshift([global.ranks.combos.RoyalFlush, maxRank]);		
			}
		}
		return this;
	}

	this.addThreeOfAKind = function () {
		if (this.ranksByCount[3]) {
			this.outcome.unshift([global.ranks.combos.ThreeOfAKind, this.ranksByCount[3][0]]);
		}
		return this;
	}

	this.addPairs = function () {
		if (this.ranksByCount[2]) {
			//add all one pair
			for(var i = 0; i < this.ranksByCount[2].length; i++) {
				this.outcome.unshift([global.ranks.combos.OnePair, this.ranksByCount[2][i]]);
			}
			if (this.ranksByCount[2].length > 1) {
				this.outcome.unshift([global.ranks.combos.TwoPairs, Math.max.apply(Math, this.ranksByCount[2])]);
			}
		}
		
		return this;
	}

	this.addHighCards = function() {
		var comboValue = global.ranks.combos.HighCard;
		var cardsNum = this.cards.length;
		for (i = 0; i < cardsNum; i++) {
			this.outcome.unshift([comboValue, this.cardRanks[i]]);
		}
		return this;
	}
}




