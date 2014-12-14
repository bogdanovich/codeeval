import scala.collection.mutable.ArrayBuffer

object Main extends App {

  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  for (l <- lines) {
    
    var numbers = ArrayBuffer[String]()
    var words   = ArrayBuffer[String]()
    var elements = l.split(',').foreach { element =>
      if (element.forall(_.isDigit)) 
        numbers += element
      else
        words += element        
    }
    //println(numbers.mkString(","))
    println(words.mkString(",") + "|" + numbers.mkString(","))
  }
}