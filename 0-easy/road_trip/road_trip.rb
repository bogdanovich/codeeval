ARGF.each do |line|
  line = line.strip
  distances = line.split(";").map {|city_info| city_info.split(",")[1].to_i}.sort
  output = [distances[0]]
  (1...distances.size).each do |i|
    output << distances[i] - distances[i - 1]
  end
  puts output.join(",")
end