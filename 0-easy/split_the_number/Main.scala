object Main extends App {
  
  def calcEval(operand1: String, operand2: String, operator: String): String = {
    operator match {
      case "+" => (operand1.toInt + operand2.toInt).toString
      case "-" => (operand1.toInt - operand2.toInt).toString
    }
  }
  
  def splitNumber(input: String): String = {
    val tmp = input.split(' ')
    var i = tmp(1).indexOf("-")
    if (i > 0) {
      return calcEval(tmp(0).substring(0, i), tmp(0).substring(i), "-")
    }
    
    i = tmp(1).indexOf("+")
    if (i > 0) {
      return calcEval(tmp(0).substring(0, i), tmp(0).substring(i), "+")
    }
      
    return input
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  
  for (l <- lines) {
    println(splitNumber(l))
  }
}