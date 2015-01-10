if [255,0,0,0].pack("i")[0...1] == "\xFF"
  puts "LittleEndian"
else
  puts "BigEndian"
end