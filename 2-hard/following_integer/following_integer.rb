def following_integer(number_string)
	number = number_string.chars.map {|char| char.to_i}.unshift 0
	last_digit_index = number.count - 1

	(last_digit_index - 1).downto(0) do |i|
		last_digit_index.downto(i) do |j|
			if number[j] > number[i]
				number[j], number[i] = number[i], number[j]
				higher_digits = number[0, i + 1]
				lower_digits = number[i + 1, number.count].sort
				result = higher_digits + lower_digits
				result.shift if result[0] == 0
				return result.join("")
			end
		end
	end

end

File.open(ARGV[0]).each_line do |line|
	number_string = line.strip
	puts following_integer(number_string)
end
