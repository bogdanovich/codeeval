require 'json'

File.open(ARGV[0]).each_line do |line|
  line = line.strip
  next if line.empty?
  json =  JSON.parse(line)
  sum = 0;
  json["menu"]["items"].each do |items|
    if (items && !items['label'].nil?)
      sum += items['id'].to_i
    end
  end
  puts sum
end
