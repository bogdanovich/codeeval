COINS = [5, 3, 1]

def minimum_coins(input)
  amount = input.to_i
  coins_number = 0
  COINS.each do |coin|
    while amount >= coin
      if amount >= coin
        coins_number += 1
        amount -= coin
      end
    end 
  end
  coins_number
end

ARGF.each do |line|
  line = line.strip
  next if line.empty?
  puts minimum_coins(line)
end