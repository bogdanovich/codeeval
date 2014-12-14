import scala.io.Source

object Main extends App {
  
    def majorNumber(input: String): String = {
      val numbers = input.split(',').map(_.toInt)
      var counters = scala.collection.mutable.Map[Int, Int]()
      for(number <- numbers) { 
        counters(number) = counters.getOrElse(number, 0) + 1
      }
      val max = counters.maxBy(_._2)
      if (max._2 > numbers.length / 2) 
        return max._1.toString
      else
        return "None"
    }
  
    if (args.length > 0) {
      for(line <- Source.fromFile(args(0)).getLines())
        println(majorNumber(line))
    } else
      Console.err.println("Please enter file name")

}