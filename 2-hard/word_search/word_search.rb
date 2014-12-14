BOARD = [['A','B', 'C', 'E'],['S', 'F', 'C', 'S'],['A', 'D', 'E', 'E']]
BOARD_WIDTH  = BOARD.first.size
BOARD_HEIGHT = BOARD.size 


def search_word(board, word)
  board.each_with_index do |row, i|
    row.each_with_index do |letter, j|
      result = find_recursive(i, j, board, word)
      return 'True' if result
    end
  end
  return 'False'
end

def find_recursive(i, j, board, word)
  return true if word.empty?

  return false if i < 0 || i >= BOARD_HEIGHT
  return false if j < 0 || j >= BOARD_WIDTH

  return false if board[i][j] != word[0]

  board_copy = Marshal.load(Marshal.dump(board))
  board_copy[i][j] = '*'

  return true if find_recursive(i - 1, j, board_copy, word[1..-1])
  return true if find_recursive(i + 1, j, board_copy, word[1..-1])
  return true if find_recursive(i, j - 1, board_copy, word[1..-1])
  return true if find_recursive(i, j + 1, board_copy, word[1..-1])

  return false
end

File.open(ARGV[0]).each_line do |line|
  if word = line.strip
    puts search_word(BOARD, word)
  end
end
