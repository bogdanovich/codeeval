object Main extends App {
  
  def compressedSequence(input: String): String = {
    val sequence = input.split(' ')
    var result = new StringBuilder
    var counter = 0
    var currentElement = sequence(0)
    for(i <- 0 until sequence.length) {
      if (sequence(i) == currentElement) {
        counter += 1
      } else {
        result.append(counter).append(" ").append(currentElement).append(" ")
        counter = 1
        currentElement = sequence(i)
      }
    }
    if (counter > 0)
      result.append(counter).append(" ").append(currentElement) 
    
    return result.toString.trim
  }
  
  val source = scala.io.Source.fromFile(args(0))
  val lines = source.getLines.filter(_.length > 0)
  
  for (l <- lines) {
    println(compressedSequence(l))
  }
}