@month_to_number = {
  "Jan" => 0, "Feb" => 1, "Mar" => 2, "Apr" => 3, "May" => 4, "Jun" => 5, "Jul" => 6, 
  "Aug" => 7, "Sep" => 8, "Oct" => 9, "Nov" => 10, "Dec" => 11
}

def month_index(date)
  month, year = date.split(" ")
  (year.to_i - 1990) * 12 + @month_to_number[month]
end

def fill_interval(months_flags, interval)
  start_period, end_period = interval.split('-')
  start_index = month_index(start_period)
  end_index   = month_index(end_period)
  (start_index..end_index).each do |i|
    months_flags[i] = 1
  end
end

def working_experience(input)
  intervals = input.split("; ")
  months_flags = Array.new(372, 0)
  intervals.each do |interval|
    fill_interval(months_flags, interval)
  end
  months_flags.reduce(:+)
end

File.open(ARGV[0]).each_line do |line|
  line = line.strip
  next if line.empty?
  puts working_experience(line) / 12
end