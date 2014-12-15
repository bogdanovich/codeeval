$font = [
  '-**----*--***--***---*---****--**--****--**---**--',
  '*--*--**-----*----*-*--*-*----*-------*-*--*-*--*-',
  '*--*---*---**---**--****-***--***----*---**---***-',
  '*--*---*--*-------*----*----*-*--*--*---*--*----*-',
  '-**---***-****-***-----*-***---**---*----**---**--',
  '--------------------------------------------------',
]

def print_digits(digits)
  digits = digits.map(&:to_i)
  for row in 0..5
    digits.each do |digit|
      print $font[row][digit * 5, 5]
    end
    puts
  end
end

ARGF.each do |line|
  line = line.strip
  next if line.empty?
  digits = line.chars.select {|char| char =~ /[0-9]/}
  print_digits(digits)
end