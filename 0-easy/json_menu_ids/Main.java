import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.*;

public class Main {

	public static void main(String[] args) throws Exception {
		File file = new File(args[0]);
        BufferedReader in = new BufferedReader(new FileReader(file));
        String line;
        while ((line = in.readLine()) != null) {
       		if (!line.equals("")) {
       			List<String> allMatches = new ArrayList<String>(); 
       			Matcher m = Pattern.compile("\"id\": (\\d+), \"label\"").matcher(line);
       			while (m.find()) {
       			   allMatches.add(m.group(1));
       			}
       			int sum = 0;
       			if (allMatches.size() > 0) {
           			for(String id : allMatches) {
           				sum += Integer.parseInt(id); 
           			}
       			}
       			
       			System.out.println(sum);
       		}
        }
        in.close();
	}

}