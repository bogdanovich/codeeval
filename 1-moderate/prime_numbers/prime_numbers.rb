class Prime

  def self.prime?(number)
    return false if number <= 1 || !number.integer?
    for i in 2..Math.sqrt(number).to_i
      return false if (number % i == 0)
    end
    true
  end

  def self.each(size)
    primes = self.sequence
    return primes unless block_given?
    size.times { yield primes.next }
  end

  def self.first(size)
    self.sequence.take(size)
  end

  def self.up_to(number)
    primes = self.sequence
    result = []
    loop do
      prime = primes.next
      if prime <= number
        result << prime
      else
        break
      end
    end
    result
  end

private
  def self.sequence
    Enumerator.new do |y|
      n = 2
      loop do
        y << n if self.prime?(n)
        n += 1
      end
    end
  end

end

ARGF.each do |line|
  line = line.strip
  next if line.empty?
  puts Prime.up_to(line.to_i).join(",")
end