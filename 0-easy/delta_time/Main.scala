import scala.io.Source
import java.text.SimpleDateFormat
import scala.concurrent.duration

object Main extends App {
  
    def timediff(input: String): String = {
      val timeFormat = new SimpleDateFormat("HH:mm:ss")
      val times = input.split(" ").map(timeFormat.parse(_))
      val diffSeconds = (times(0).getTime() - times(1).getTime()).abs / 1000 
      val s = diffSeconds % 60
      val m = (diffSeconds/60) % 60
      val h = (diffSeconds/60/60) % 24
      return "%02d:%02d:%02d".format(h, m, s)
    }
  
    if (args.length > 0) {
      for(line <- Source.fromFile(args(0)).getLines())
        println(timediff(line))
    } else
      Console.err.println("Please enter file name")

}