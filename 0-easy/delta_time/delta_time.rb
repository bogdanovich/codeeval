require 'time'

File.open(ARGV[0]).each_line do |line|
  line = line.strip
  time1, time2 = line.split(" ")
  puts Time.at((Time.parse(time1) - Time.parse(time2)).abs).utc.strftime "%H:%M:%S"
end