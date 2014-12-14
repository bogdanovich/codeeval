# https://github.com/pdamer/munkres
class Munkres
  MODE_MINIMIZE_COST = 1
  MODE_MAXIMIZE_UTIL = 2
  
  def initialize(matrix=[], mode=MODE_MINIMIZE_COST)
    @matrix = matrix
    @mode = mode
    @original = Marshal.load(Marshal.dump(@matrix))
    validate_and_pad
    @covered_columns = []
    @covered_rows = []
    @starred_zeros = []
    @primed_zeros = []
    
    class << @matrix
      

      def row(index)
        self[index]
      end

      def column(index)
        self.collect do |row|
          row[index]
        end
      end

      def columns
        result = []
        self.first.each_index do |i|
          result << self.column(i)
        end
        result
      end
      
      def each_column_index &block
        column_indices.each &block
      end
      
      def column_indices
        @column_indices ||= (0...self.first.size).to_a
      end
      
      def row_indices
        @row_indices ||= (0...self.size).to_a
      end
    end
    
  end
  
  def find_pairings
    create_zero_in_rows
    star_zeros
    cover_columns_with_stars
    while not done?
      p = cover_zeros_and_create_more
      find_better_stars p
      #create series
      cover_columns_with_stars
    end
    @pairings = @starred_zeros.delete_if{|row_index,col_index| col_index >= @original.first.size || row_index >= @original.size}
  end
  
  def total_cost_of_pairing
    @pairings.inject(0) {|total, star| total + @original[star[0]][star[1]]}
  end
  
  def pretty_print
    print_col_row
    @matrix.each_with_index do |row,row_index|
      print @covered_rows.include?(row_index) ? "-" : " "
      row.each_with_index do |value, col_index|
        print value
        print "*" if @starred_zeros.include? [row_index,col_index]
        print "'" if @primed_zeros.include? [row_index,col_index]
        print "\t"
      end
      print @covered_rows.include?(row_index) ? "-" : " "
      print "\n"
    end
    print_col_row
  end
  
  def print_col_row
    print " "
    @matrix.column_indices.each do |col_index|
      print "|" if @covered_columns.include? col_index
      print "\t"
    end
    print "\n"
  end
  
  protected
  
  attr_accessor :matrix, :covered_columns, :covered_rows, :starred_zeros, :primed_zeros, :primed_starred_series
  
  def create_zero_in_rows
    @matrix.each_with_index do |row,row_index|
      min_val = min_or_zero(row)
      row.each_with_index do |value, col_index|
        @matrix[row_index][col_index] = value - min_val
      end
    end
  end
  
  def star_zeros 
    unstarred_columns = @matrix.column_indices
    
    @matrix.each_with_index do |row, row_index|
      star = star_in_row?(row_index)
      next if star
      unstarred_columns.each do |col_index|
          if (row[col_index] == 0 and !star_in_column?(col_index))
          @starred_zeros << [row_index, col_index]
          unstarred_columns -= [col_index]
          break # go to next row
        end
      end
    end
  end
  
  def cover_columns_with_stars
    cols = @starred_zeros.collect {|z| z[1]}
    cols.uniq!
    @covered_columns += cols
  end
  
  def prime_first_uncovered_zero
    my_cols = uncovered_columns #silly workaround to cache the list
    
    uncovered_rows.each do |row_index|
      my_cols.each do |col_index|
        if @matrix[row_index][col_index] == 0
          @primed_zeros << [row_index, col_index]
          return [row_index, col_index]
        end
      end
    end
    nil
  end
  
  def smallest_uncovered_value
    min_value = nil 
    my_cols = uncovered_columns #silly workaround to cache the list
    uncovered_rows.each do |row_index|
      my_cols.each do |col_index|
        value = @matrix[row_index][col_index]
        min_value ||= value
        min_value = value if value < min_value
        return 0 if min_value == 0
      end
    end
    min_value
  end
  
  def add_and_subtract_for_step_6(delta=0)
    covered_rows.each do |row_index|
      covered_columns.each do |col_index|
        @matrix[row_index][col_index] += delta
      end
    end


    my_cols = uncovered_columns #silly workaround to cache the list
    
    uncovered_rows.each do |row_index|
      my_cols.each do |col_index|
        @matrix[row_index][col_index] -= delta
      end
    end
  end
  
  def find_better_stars(first_zero)
    primes_series = [first_zero]
    stars_series = []
    while next_star = @starred_zeros.detect{|row, col| col == primes_series.last[1] }
      stars_series << next_star
      primes_series << @primed_zeros.detect{|row, col| row == stars_series.last[0] }
    end
    stars_series.each do |star|
      @starred_zeros.delete(star)
    end
    
    primes_series.each do |prime|
      @starred_zeros << prime
    end
    
    @primed_zeros = []
    @covered_columns = []
    @covered_rows = []
  end
  
  def done?
    @matrix.column_indices.size == covered_columns.size
  end
  
  def min_or_zero(collection)
    collection.index(0) ? 0 : collection.min
  end
  
  def star_in_row?(index)
    @starred_zeros.any? {|row_index,col_index| row_index == index}
  end
  
  def star_in_row(index)
    @starred_zeros.assoc index
  end  
  
  def star_in_column?(index)
    @starred_zeros.any? {|row_index,col_index| col_index == index}
  end
  
  def uncovered_rows
    @matrix.row_indices - @covered_rows 
  end
  
  def uncovered_columns
    @matrix.column_indices - @covered_columns
  end
  
  #step 4
  def cover_zeros_and_create_more
    loop do
      while prime = prime_first_uncovered_zero
        if star = star_in_row(prime[0]) 
          @covered_rows << prime[0]
          @covered_columns -= [star[1]] 
        else
          return prime
        end
      end
      
      add_and_subtract_for_step_6(smallest_uncovered_value)
    end
  end
  
  def validate_and_pad
    raise(ArgumentError, "Munkres matrix is empty") unless @matrix.first
    raise(ArgumentError, "Munkres first row is empty") unless @matrix.first.size > 0
    raise(ArgumentError, "Munkres matrix is not rectangular", caller) if @matrix.any? {|row| row.size != @matrix.first.size } 
    raise(ArgumentError, "Munkres matrix is wider than it is tall", caller) if @matrix.size < @matrix.first.size
  
    if @matrix.size > @matrix.first.size
      number_of_cols = @matrix.first.size
      @matrix.each_with_index do |row, row_index|
        (number_of_cols...@matrix.size).each do |col_index|
          @matrix[row_index][col_index] = 0
        end
      end
    end
    
    if MODE_MAXIMIZE_UTIL == @mode
      max_value = @matrix.flatten.max
      @matrix.each_with_index do |row, row_index|
        row.each_with_index do |value, col_index|
          @matrix[row_index][col_index] = max_value - value
        end
      end
    end
    
  end
  
end


$cache ||= {letters: {}, vowels: {}, consonants: {}}

def vowels_count(s)
  if !$cache[:letters][s]
    $cache[:letters][s] = s.scan(/a|e|i|o|u|y|A|E|I|O|U|Y/).size
  end
  $cache[:letters][s]
end

def consonants_count(s)
  if !$cache[:vowels][s]
    $cache[:vowels][s] = s.scan(/b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z|B|C|D|F|G|H|J|K|L|M|N|P|Q|R|S|T|V|W|X|Z/).size
  end
  $cache[:vowels][s]
end

def letters_count(s)
  if !$cache[:consonants][s]
    $cache[:consonants][s] = s.scan(/[A-Za-z]/).size
  end
  $cache[:consonants][s]
end

def ss_score(name, product)
  name_letters = letters_count(name)
  product_letters = letters_count(product)
  name_vowels = vowels_count(name)
  score = 0
  if product_letters.even?
    score = 1.5 * name_vowels
  else
    score = consonants_count(name)
  end
  score *= 1.5 if name_letters.gcd(product_letters) > 1
  score
end

INF = 10000000



File.open(ARGV[0]).each_line do |line|

  begin

  line = line.strip
  next if line.empty?
  names, products = line.strip.split(';').map {|str| str.split(",")}
  
  if (!names || !products)
    puts "0.00"
    next
  end

  scores = [];
  set = []
  max_score = 0
  
  

  names.each_with_index do |name, i|
    products.each_with_index do |product, j|
      score = ss_score(name, product)
      scores[i] ||= []
      scores[i][j] = score
      set << [name, product, score]
      max_score = scores[i][j] if score > max_score
    end
  end



  # modify matrix to find maximum instead of minimum and make it rectangular
  modified_scores = scores.map {|row| row.map {|cell| max_score - cell} }
  h = modified_scores.length
  w = modified_scores[0].length

  if (h > w)
    modified_scores.each_with_index {|row, i| modified_scores[i] += Array.new(h - w, INF)}
  end
  if (w > h)
    (w - h).times { modified_scores << Array.new(w, INF) }
  end

  m = Munkres.new(modified_scores)
  pairs = m.find_pairings
  
  result_set = []
  total_score = 0
  pairs.each do |pair|
    i,j = pair
    if (names[i] && products[j])
      result_set << [names[i], products[j], scores[i][j]]
      total_score += scores[i][j]
    end
  end

  puts "%.2f" % total_score

  rescue NoMethodError => e
    p line
    exit
  end

end

