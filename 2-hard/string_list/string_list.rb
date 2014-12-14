File.open(ARGV[0]).each_line do |line|
	length, string = line.strip.split(",")
	result = string.chars.sort.repeated_permutation(length.to_i).to_a.uniq.map {|a| a.join }.join(",")
	puts result
end
