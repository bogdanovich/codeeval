def brute_force(coords)
  min_distance = 10000
  min_distance_points = []
  coords.each do |p1|
    coords.each do |p2|
      next if p1 == p2
      distance = Math.sqrt((p1[0] - p2[0]) ** 2 + (p1[1] - p2[1]) ** 2)
      if min_distance > distance
        min_distance = distance
        min_distance_points = [p1, p2]
      end
    end
  end
  min_distance
end

def binary_tree(coords)
end

def closest_pair(coords)
  brute_force(coords)  
end


lines_iterator = File.open(ARGV[0]).each_line
line = lines_iterator.next.strip  
begin
  coords = []
  input = line.split(" ")
  n = input[0].to_i
  n.times { 
    input = lines_iterator.next.strip.split(" ")
    coords << [input[0].to_i, input[1].to_i]
  }
  min_distance = closest_pair(coords)
  puts (min_distance < 10000) ? "%.4f" % min_distance : "INFINITY"
  
end while (line = lines_iterator.next.strip) != "0"
  


  
