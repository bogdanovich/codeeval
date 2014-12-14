def card_number_valid?(number)
  return "0" if number.size < 12 || number.size > 19
  
  sum = number.reverse.chars.each_with_index.reduce(0) do |sum, (value, index)|
    summand = (index.to_i.odd?) ? value.to_i * 2 : value.to_i
    if summand >= 10
      summand = summand / 10 + summand % 10
    end
    sum + summand
  end
  return (sum % 10 == 0) ? "1" : "0"
end

File.open(ARGV[0]).each_line do |line|
  line = line.strip.gsub(" ", "")
  next if line.empty?
  
  puts card_number_valid?(line)
end