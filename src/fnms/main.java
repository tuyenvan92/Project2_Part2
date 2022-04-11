package fnms;

import com.sun.corba.se.impl.ior.WireObjectKeyTemplate;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.Random;
import java.util.Scanner;
import java.util.stream.Collectors;

public class main {

    public static List<Item> goods = new ArrayList<Item>();
    public static List<Item> waitList = new ArrayList<Item>();
    public static List<Item> sellList = new ArrayList<Item>();
    public static List<Item> damageList = new ArrayList<Item>();
    //public static Logger logger = new Logger("main.java");
    //public static List<Item> soldList = new ArrayList<Item>();
    public static List<Item> boughtList = new ArrayList<Item>();
    public static double CashRegister = 0;
    public static double dept = 0;

    //function arrive at store
       
   
    //random the percentage
    public static boolean percentage(int n) {
        int i = new Random().nextInt(100);
        if (i < n) {
            return true;
        }
        return false;
    }

    private static void writeToFile(String filename, String text) {
        try {
            File myObj = new File(filename + ".txt");
            if (myObj.createNewFile()) {
                // System.out.println("File created: " + myObj.getName());
            } else {
                System.out.println("File already exists.");
            }
        } catch (IOException e) {
            System.out.println("An error occurred.");
            e.printStackTrace();
        }

        try {
            FileWriter myWriter = new FileWriter("filename.txt");
            myWriter.write(text);
            myWriter.close();
            System.out.println("Successfully Log to the file" + filename);
        } catch (IOException e) {
            System.out.println("An error occurred.");
            e.printStackTrace();
        }
    }

    private static SubjectLogger CreateLogger() {
        SubjectLogger account = new SubjectLogger();
        account.attach(new Logger());

        return account;
    }

    public static void main(String[] args) throws FileNotFoundException {
        // TODO Auto-generated method stub
//        Logger Logger = new Logger("main.java");
//        Logger.println("dsđsd");
        //intit item 
        FNMS NorthsideFNMS = new FNMS();

        System.out.println("This is northsite store");
        NorthsideFNMS.run();
        
        System.out.println("This is southsite store");
        FNMS SouthsideFNMS = new FNMS();
        SouthsideFNMS.run();

    }

}
