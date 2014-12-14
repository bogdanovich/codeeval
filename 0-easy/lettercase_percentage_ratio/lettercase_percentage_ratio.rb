File.open(ARGV[0]).each_line do |line|
  lowercase = 0
  uppercase = 0
  word = line.strip
  word.chars.each do |char|
    if /[[:upper:]]/.match(char)
      uppercase += 1
    else
      lowercase += 1
    end
  end
  lowercase_percent = "%.2f" % (lowercase.to_f / word.size * 100)
  uppercase_percent = "%.2f" % (uppercase.to_f / word.size * 100)
  puts "lowercase: #{lowercase_percent} uppercase: #{uppercase_percent}"
end
