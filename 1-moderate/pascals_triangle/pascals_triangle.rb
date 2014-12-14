def max_total(triangle)
  for i in 1..triangle.length - 1
    for j in 0..triangle[i].length - 1
      if (j == 0)
        triangle[i][j] += triangle[i - 1][j] 
      elsif (j == triangle[i].length - 1)
        triangle[i][j] += triangle[i - 1][j - 1] 
      else
        triangle[i][j] += [triangle[i - 1][j], triangle[i - 1][j - 1]].max 
      end
    end
  end
  triangle.last.max
end


def pass_triangle(triangle, height, i = 0, j = 0)
  sum = triangle[i][j]
  if i < height - 1
    sum_left  = sum + pass_triangle(triangle, height, i + 1, j)
    sum_right = sum + pass_triangle(triangle, height, i + 1, j + 1)
    sum = (sum_left > sum_right) ? sum_left : sum_right
  end
  sum
end

lines = File.read(ARGV[0])
triangle = lines.split("\n").map {|row| row.split(" ").map {|cell| cell.to_i}}
puts max_total(triangle)