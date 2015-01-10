def guess_the_number(input)
  inputs = input.split(" ")
  min = 0
  max = inputs[0].to_i
  guess = ((max - min) / 2.0).ceil
  inputs[1..-1].each do |answer|
    case answer
    when "Higher"
      min = guess + 1
    when "Lower"
      max = guess - 1
    when "Yay!"
      break
    end
    guess = (min + (max - min) / 2.0).ceil
  end
  guess
end

ARGF.each do |line|
  line = line.strip
  next if line.empty?
  puts guess_the_number(line)
end