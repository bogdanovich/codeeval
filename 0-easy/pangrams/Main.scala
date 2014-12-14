import scala.io.Source

object Main extends App {
  
    def pangram(input: String): String = {
      val lettersArray = "abcdefghijklmnopqrstuvwxyz".toCharArray
      val result = lettersArray.filter(letter => !input.contains(letter))
      if (result.length > 0) {
        return result.mkString
      }
      return "NULL"
    }
  
    if (args.length > 0) {
      for(line <- Source.fromFile(args(0)).getLines())
        println(pangram(line))
    } else
      Console.err.println("Please enter file name")

}