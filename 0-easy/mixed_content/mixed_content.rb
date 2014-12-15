ARGF.each do |line|
  line = line.strip
  next if line.empty?
  input = line.split(",")
  numbers = []
  words = []
  input.each do |element|
    if element =~ /[0-9]/
      numbers << element
    else
      words << element
    end
  end
  if words.empty? || numbers.empty?
    puts line
  else
    puts words.join(",") + "|" + numbers.join(",")
  end
end