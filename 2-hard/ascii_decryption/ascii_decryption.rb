def decrypt_message(msg, word_length, last_char)
  last_char_ascii = last_char.ord
  space_ascii = " ".ord
  difference = last_char_ascii - space_ascii

  repeated = []
  for i in 0..msg.count - 2
    if msg[i] - msg[i + 1] == difference && msg[i - word_length] == msg[i + 1]
      repeated << i
    end
  end
  if repeated.count == 2
    n = last_char_ascii - msg[repeated.first]
    return msg.map {|ascii| (ascii + n).chr }.join

  end
end


content = File.read(ARGV[0])
word_length, last_char, encrypted_message = content.split(" | ")
encrypted_message = encrypted_message.split(" ").map {|char| char.to_i}
last_char_ascii = last_char.ord
space_ascii = " ".ord
puts decrypt_message(encrypted_message, word_length.to_i, last_char)


