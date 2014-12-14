File.open(ARGV[0]).each_line do |line|
  line = line.strip
  next if !line
  a = line.split(line[0])
  if a.empty?
    puts 1
  else
    puts a[1].length + 1 
  end
end