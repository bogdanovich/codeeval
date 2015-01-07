def flavius_josephus(input)
  m, n = input.split(',').map {|element| element.to_i}
  arr = (0...m).to_a
  result = []
  i = 0
  j = 0
  while arr.size > 0
    if (i + 1) % n == 0
      # executing
      result << arr[j]
      arr.delete_at(j)
    else
      j += 1
    end
    i += 1
    j = 0 if j >= arr.size
  end
  result.join(" ")
end

ARGF.each do |line|
  line = line.strip
  next if line.empty?
  #puts line
  puts flavius_josephus(line)
end
