File.open(ARGV[0]).each_line do |line|
  line = line.strip
  next if !line
  puts line.split(" ")[-2]
end