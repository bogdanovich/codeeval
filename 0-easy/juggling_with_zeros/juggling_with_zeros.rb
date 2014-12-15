ARGF.each do |line|
  input = line.strip.split(" ")
  output = ""
  (0..input.size).step(2).each do |i|
    if input[i] == "00"
      output << Array.new(input[i + 1].size, "1").join
    elsif input[i] == "0"
      output << input[i + 1]
    end
  end  
  puts output.to_i(2)
end