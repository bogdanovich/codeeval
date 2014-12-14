import java.io.File;
import java.io.FileReader;
import java.io.BufferedReader;
import java.util.Arrays;

public class Main {
    
    public static int isHappyNumber(String inputNumber, int depth) {
        if (depth < 0) {
            return 0;
        }
        char[] digitsArray = inputNumber.toCharArray();
        int squaresSum = 0;
        for(int i = 0; i < digitsArray.length; i++) {
            squaresSum += Math.pow(Character.getNumericValue(digitsArray[i]), 2);
        }
        if (squaresSum == 1) {
        	return 1;
        } else {
        	return isHappyNumber(Integer.toString(squaresSum), --depth);
        }
    }

    public static void main (String[] args) throws Exception {
        File file = new File(args[0]);
        BufferedReader in = new BufferedReader(new FileReader(file));
        String line;
        while ((line = in.readLine()) != null) {
            System.out.println(isHappyNumber(line.trim(), 10));
        }
        in.close();
  }
}
