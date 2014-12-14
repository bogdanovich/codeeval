object Main extends App {
  
  def swapNumbers(input: String): String = {
    val tmp = input.split(':')
    var array = tmp(0).split(' ').map(_.toInt)
    val indexes = tmp(1).split(',').map(_.split('-').map(_.trim.toInt))
    indexes.foreach {i => 
      val temp = array(i(0))
      array(i(0)) = array(i(1))
      array(i(1)) = temp
    }
    return array.mkString(" ")
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  for (l <- lines) {
    println(swapNumbers(l))
  }
}