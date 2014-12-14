File.open(ARGV[0]).each_line do |line|
	input = line.strip.chars.sort
	puts input.permutation(input.size).to_a.map {|a| a.join}.join(",")
end
