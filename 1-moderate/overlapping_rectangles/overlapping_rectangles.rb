def overlap(x1, x2, x3, x4)
  return true if x1.between?(x3, x4) || x3.between?(x1, x2)
  false
end

def overlapping_rectangles(input)
  x1, y1, x2, y2, x3, y3, x4, y4 = input.split(",").map(&:to_i)
  if overlap(x1, x2, x3, x4) && overlap(y2, y1, y4, y3)
    return "True"
  end
  "False"
end

ARGF.each do |line|
  line = line.strip
  next if line.empty?
  puts overlapping_rectangles(line)
end