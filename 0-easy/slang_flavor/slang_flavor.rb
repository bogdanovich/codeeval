def slang_flavor(text)
  replacements = [
    ', yeah!', ', this is crazy, I tell ya.', 
    ', can U believe this?', ', eh?', ', aw yea.', 
    ', yo.', '? No way!', '. Awesome!'
  ]
  replacement = replacements.cycle

  output = ""
  every_other = false
  text.chars.each do |char|
    if char == "." || char == "?" || char == "!"
      output += (every_other) ? replacement.next : char
      every_other = !every_other
    else
      output << char
    end
  end
  output
end


text = File.read(ARGV[0])
puts slang_flavor(text)