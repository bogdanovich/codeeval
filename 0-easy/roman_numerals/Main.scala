import scala.collection.immutable.ListMap

object Main extends App {
  
  def convertToRoman(input: String): String = {
    var number = input.toInt
    var result = ""
    
    val divisors = ListMap("M" -> 1000, "CM" -> 900, "D" -> 500, "CD" -> 400,
                       "C" -> 100, "XC" -> 90, "L" -> 50, "XL" -> 40, 
                       "X" -> 10, "IX" -> 9, "V" -> 5, "IV" -> 4, "I" -> 1)
    var m = 0                   
    for ((key, value) <- divisors) {
      m = number / value
      number = number % value
      result += key * m
      
    }
    return result
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  for (l <- lines) {
    println(convertToRoman(l))
  }
}
