File.open(ARGV[0]).each_line do |line|
  if line.size > 55
    line = line[0,40]
    line = line[0, line.rindex(" ")] if line.rindex(" ")
     line += "... <Read More>"
  end
  puts line
end