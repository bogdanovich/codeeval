object Main extends App {
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  
  def matchNumber(n: String): String  = n match {
      case "one" => "1"
      case "two" => "2"
      case "three" => "3"
      case "four" => "4"
      case "five" => "5"
      case "six" => "6"
      case "seven" => "7"
      case "eight" => "8"
      case "nine" => "9"
      case "zero" => "0"
    }
  
  for (l <- lines) {
    var s_arr = l.split(';')
    s_arr.foreach { number =>
      print(matchNumber(number))
    }
    println()
  }
}