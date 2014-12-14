object Main extends App {
  
  def morseDecode(input: String): String = {
    val morseDecoder = Map(
      ".-" -> "a",    "-..." -> "b",  "-.-." -> "c", "-.." -> "d", 
      "." -> "e",     "..-." -> "f",  "--." -> "g", "...." -> "h", 
      ".." -> "i",    ".---" -> "j",  "-.-" -> "k", ".-.." -> "l", 
      "--" -> "m",    "-." -> "n",    "---" -> "o", ".--." -> "p", 
      "--.-" -> "q",  ".-." -> "r",   "..." -> "s", "-" -> "t", 
      "..-" -> "u",   "...-" -> "v",  ".--" -> "w", "-..-" -> "x",  
      "-.--" -> "y",  "--.." -> "z", " " -> " ", "" -> " ", 
      ".----" -> "1", "..---" -> "2", "...--" -> "3", "....-" -> "4", 
      "....." -> "5", "-...." -> "6", "--..." -> "7", "---.." -> "8", 
      "----." -> "9", "-----" -> "0"
    )
                
    val decoded = input.split(' ')
                       .map(charEncoded => morseDecoder(charEncoded))
                       .mkString("").toUpperCase
    return decoded
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  
  for (l <- lines) {
    println(morseDecode(l))
  }
}