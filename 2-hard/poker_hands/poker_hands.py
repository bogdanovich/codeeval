from collections import Counter
import sys

class Card:
    values = {
        '1': 1, '2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7,
        '8': 8, '9': 9, 'T': 10, 'J': 11, 'Q': 12, 'K': 13, 'A': 14
    }

    def __init__(self, card):
        self.rank, self.suit = card[0:2]
        self.value = Card.values[self.rank]

    def __repr__(self):
        return self.rank + self.suit

class Hand:
    def __init__(self, cards = []):
        self.cards = sorted(cards, key=lambda card: card.value, reverse=True)
        self.kind_count = self.__kind_count()

    @classmethod
    def from_string(cls, str):
        return cls(cards.Card(card) for card in str.split(' '))

    def result(self):
        return (self.highest_combo(), self.highest_rank_values())

    def highest_rank_values(self):
        return [card.value for card in self.cards]

    def highest_combo(self):
        return  (self.__royal_flush() or self.__straight_flush() or
                 self.__four_of_a_kind() or self.__full_house() or
                 self.__flush() or self.__straight() or
                 self.__three_of_a_kind() or self.__two_pairs() or
                 self.__one_pair() or self.__high_card())

    def __royal_flush(self):
        if self.__straight_flush() and self.cards[0].value == 14:
            return (9, self.cards[0].value)
        return None

    def __straight_flush(self):
        if self.__straight() and self.__flush():
            return (8, self.cards[0].value)
        return None

    def __four_of_a_kind(self):
        kind_count = self.kind_count
        if len(kind_count) == 2 and kind_count.values()[0] in (1,4):
            return (7, sorted(kind_count, key=lambda k: kind_count[k], reverse=True))
        return None

    def __full_house(self):
        kind_count = self.kind_count
        if len(kind_count) == 2 and kind_count.values()[0] in (2,3):
            return (6, sorted(kind_count, key=lambda k: kind_count[k], reverse=True))
        return None

    def __flush(self):
        for i in xrange(1, len(self.cards)):
            if self.cards[i].suit != self.cards[i - 1].suit:
                return None
        return (5, self.cards[0].value)

    def __straight(self):
        for i in xrange(1, len(self.cards)):
            if not self.cards[i].value == self.cards[i - 1].value - 1:
                return None
        return (4, self.cards[0].value)

    def __three_of_a_kind(self):
        kind_count = self.kind_count
        for card_value in kind_count:
            if kind_count[card_value] == 3:
                return (3, card_value)
        return None

    def __two_pairs(self):
        total_pairs = 0
        pair_values = []
        for i, first_card in enumerate(self.cards):
            for second_card in self.cards[i+1:]:
                if first_card.value == second_card.value:
                    total_pairs += 1
                    pair_values.append(first_card.value)
        if total_pairs == 2:
            return (2, sorted(pair_values, reverse=True))
        return None

    def __one_pair(self):
        for i, first_card in enumerate(self.cards):
            for second_card in self.cards[i+1:]:
                if first_card.value == second_card.value:
                    return (1, first_card.value)
        return None

    def __high_card(self):
        return (0, self.cards[0].value)

    def __kind_count(self):
        return dict(Counter([card.value for card in self.cards]))

with open(sys.argv[1], 'r') as f:
    for line in f:
        crds = [Card(card) for card in line.split(' ')]
        left = Hand(crds[:5]).result()
        right = Hand(crds[5:]).result()
        if left > right:
            print 'left'
        elif left < right:
            print 'right'
        else:
            print 'none'
