object Main extends App {
  //println(args.size)
  
  def getLowestUnique(input: Array[Int]): Int = {
    val a = input.sorted
    for(i <- 0 until a.size) {
      if (i == 0) {
        if (a(i) != a(i + 1)) { return a(i) }  
      } else if (i > 0 && i < a.size - 1) {
        if (a(i) != a(i - 1) && a(i) != a(i + 1)) { return a(i) }
      } else {
        if (a(i) != a(i - 1)) { return a(i) }
      }
    }
    return 0
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  
  for (l <- lines) {
    val numbers = l.split(" ").map(number => number.toInt)
    //numbers.sorted.foreach(n => print(n))
    //println
    println(numbers.indexOf(getLowestUnique(numbers)) + 1)
    
  }
}
