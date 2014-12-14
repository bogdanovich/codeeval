object Main extends App {
  
  def hiddenDigits(input: String): String = {
    var result = ""
    for(character <- input) {
      if (character.isDigit)
        result += character
      if(character >= 'a' && character <= 'j')
        result += (character.toInt - 'a'.toInt).toString
    }
    if (result == "")
      result = "NONE"
    return result
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  
  for (l <- lines) {
    println(hiddenDigits(l))
  }
}