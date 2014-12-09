
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.Random;

/**
 *
 * @author Andrew
 */
public class CodeGrader {

    private String directory;
    private String filename;
    
    Student student;
    Instructor instructor;

    public CodeGrader(String directory, String filename, int a , int b, int c) {
        this.directory = directory;
        this.filename = filename;
        // Random rand = new Random();
        // int a = rand.nextInt(50);
        // int b = rand.nextInt(50);
        // int c = rand.nextInt(50);

        System.out.println(filename);
        //System.out.println(a + ", " + b + ", " + c);

        student = new Student(a, b, c, directory, filename);
        instructor = new Instructor(a, b, c);
        String intstring = instructor.output;
        String stustring = student.output;
        if(intstring.equals(stustring)){
            System.out.println("Output is the game good job");
        } else {
            System.out.println("Output is not the same");
        }
    }

    public static void main(String[] args) {
        new CodeGrader(args[0], args[1], Integer.parseInt(args[2]), Integer.parseInt(args[3]), Integer.parseInt(args[4]));
    }
}   

class Student {

    private int a, b, c, root1, root2;
    public String output = "";

    public Student(int a, int b, int c, String directory, String filename) {
        this.a = a;
        this.b = b;
        this.c = c;
        runProgram("javac " + filename);
        runProgram("java -cp " + directory + " Assignment1_0000" + " " + a + " " + b + " " + c);
        //output.replaceAll("\\s+","");
        System.out.println(output);
    }
    
    public void runProgram(String s){
        try {
        // run the Unix "ps -ef" command
            // using the Runtime exec method:
            Process p = Runtime.getRuntime().exec(s);
             
            BufferedReader stdInput = new BufferedReader(new
                 InputStreamReader(p.getInputStream()));
 
            BufferedReader stdError = new BufferedReader(new
                 InputStreamReader(p.getErrorStream()));
 
            // read the output from the command
            while ((s = stdInput.readLine()) != null) {
                output += s;
                output += "\n";
                //System.out.println(s);
            }
             
            // read any errors from the attempted command
            while ((s = stdError.readLine()) != null) {
                System.out.println(s);
            }
        }
        catch (IOException e) {
            System.out.println("exception happened - here's what I know: ");
            e.printStackTrace();
        }
    }
}

class Instructor {

    private int a, b, c;
    public double root1, root2;
    public String output;

    public Instructor(int a, int b, int c) {
        this.a = a;
        this.b = b;
        this.c = c;
        findRoots();
        System.out.println(output);
    }

    public double discr() {
        return (this.b * this.b) - (4 * this.a * this.c);
    }

    public void findRoots() {
        if (discr() < 0) {
            output = "No Real Roots\n";
            //System.out.println("No Real Roots");
            
        } else if (discr() == 0) {
            this.root1 = (this.b - Math.sqrt(discr())) / (2 * this.a);
            output = "Root: " + root1 + "\n";
            //System.out.println("Root: " + root1);
        } else {
            this.root1 = (this.b - Math.sqrt(discr())) / (2 * this.a);
            this.root2 = (this.b + Math.sqrt(discr())) / (2 * this.a);

            output =    "Root: " + root1 
                    +   "\nRoot2: " + root2
                    +   "\n";
            //System.out.println("Root: " + root1);
            //System.out.println("Root2 : " + root2);
        }
    }
}
 