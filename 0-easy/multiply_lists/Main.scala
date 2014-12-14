object Main extends App {
  
  def multiplyLists(input: String): String = {
    var lists = input.split('|').map(_.trim.split(' ').map(_.toInt))
    return lists(0).indices.map(i => lists(0)(i) * lists(1)(i)).mkString(" ")
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  for (l <- lines) {
    println(multiplyLists(l))
  }
}