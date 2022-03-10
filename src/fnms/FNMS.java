/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package fnms;

import static fnms.main.CashRegister;
import static fnms.main.boughtList;
import static fnms.main.damageList;
import static fnms.main.dept;
import static fnms.main.goods;
import static fnms.main.percentage;
import static fnms.main.sellList;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;
import java.util.Scanner;
import java.util.stream.Collectors;

/**
 *
 * @author ADMIN
 */
public class FNMS {

    public List<Item> goods = new ArrayList<Item>();
    public List<Item> waitList = new ArrayList<Item>();
    public List<Item> sellList = new ArrayList<Item>();
    public List<Item> damageList = new ArrayList<Item>();
    //public static Logger logger = new Logger("main.java");
    //public static List<Item> soldList = new ArrayList<Item>();
    public List<Item> boughtList = new ArrayList<Item>();
    public double CashRegister = 0;
    public double dept = 0;

    //function arrive at store
    public void ArriveAtStore(Staff staff) {
        //check item in waitting list
        for (Item i : waitList) {
            System.out.println(staff.name + " find " + i.name + " in wait list");

        }
        System.out.println("--------------------------------");

        //add item in waiting list to the inventory
        for (Item i : waitList) {
            System.out.println(staff.name + " add " + i.name + " to the store");
            System.out.println("--------------------------------");
            goods.add(i);

        }
        System.out.println("number of items added to inventory: " + waitList.size());
        System.out.println("--------------------------------");

        waitList = new ArrayList<Item>();
    }

    //get the staff to the Store randomly
    public Staff StaffReport(List<Staff> list) {
        int index = new Random().nextInt(list.size());
        return list.get(index);
    }

    //check the register for action go to the bank
    public boolean CheckRegister(Staff staff) {

        if (CashRegister < 75) {
            return true;

        }
        System.out.println(staff.name + " inform that go to the bank,withdraw $1000 ");
        System.out.println("--------------------------------");
        return false;
    }

    //go to bank action
    public void GoToBank(Staff staff) {
        //add 1000USD to cash register
        CashRegister += 1000;
        dept += 1000;
        System.out.println(staff.name + " inform that the insufficient money in the register is " + CashRegister);
        System.out.println("--------------------------------");
    }
    //DoInventory action

    public void DoInventory(Staff staff) {

        //get total value of all items
        double value = 0;
        for (Item s : goods) {
            value += s.purchasePrice;
        }
        System.out.println(staff.name + " inform that value of all the items in the store is " + value);

        TuneAlgorithm tuneAlgorithm = new ElectronicAlgorithm();
        for (int i = 0; i < goods.size(); i++) {
            tuneAlgorithm.go(staff, goods.get(i));
            if (percentage(10)) {
                DamageAnItem(staff, goods.get(i));
            }
        }
        double totalPurcharsePrice = 0;
        for (Item i : goods) {
            totalPurcharsePrice += i.purchasePrice;
        }
        System.out.println("Total purchase price: " + totalPurcharsePrice);
        System.out.println("Total dammage item: " + damageList.size());
        System.out.println("--------------------------------");

    }

    //Place an order action
    public void PlaceAnOrder(Staff staff, Item item) {
        //add item to waitting list 
        waitList.add(item);
        CashRegister -= item.purchasePrice;
        System.out.println(staff.name + " inform that purchase " + item.name + " with value " + item.purchasePrice);
        System.out.println("CashRegister now: " + CashRegister);
        System.out.println("--------------------------------");
    }

    public void PlaceAnOrder() {
        System.out.println("Total number of items ordered: " + waitList.size());
        System.out.println("--------------------------------");
    }

    //action ocoure since a customer want to buy something
    public void sell(Staff staff, String customerName, int Day, Item item) {
        System.out.println(staff.name + " sold a " + item.name + " to " + customerName + " for " + item.listPrice);
        goods.remove(item);
        CashRegister += item.listPrice;
        System.out.println("CashRegister now: " + CashRegister);
        item.daySold = Day;
        sellList.add(item);
    }

    public void BuyingCustomer(Staff staff, String customerName, int Day) {
        System.out.print("Item type the customer want to buy: ");
        Scanner sc = new Scanner(System.in);
        String name = sc.nextLine();

        //find the item customer want to buy
        List<Item> items = goods.stream().filter(s -> s.name.equals(name)).collect(Collectors.toList());

        //notify when this item out of stock
        if (items.size() == 0) {
            System.out.println(customerName + " wanted to buy a " + name + " but none were in inventory, so they left");
            return;
        };

        //check the demand of customer
//        System.out.print("Do customer buy " + items.get(0).name + " with price " + items.get(0).listPrice + "? (yes/no): ");
//        String option = sc.nextLine();
        int per = 50;
        try {
            Players itemPlayers = (Players) items.get(0);
            if (itemPlayers.equalized) {
                per += 10;
            }
        } catch (Exception e) {

        }
        try {
            Stringed item = (Stringed) items.get(0);
            if (item.tuned) {
                per += 15;
            }
        } catch (Exception e) {

        }
        try {
            Wind item = (Wind) items.get(0);
            if (item.adjusted) {
                per += 20;
            }
        } catch (Exception e) {

        }
        if (percentage(per)) {
            System.out.println(staff.name + " sold a " + items.get(0).name + " to " + customerName + " for " + items.get(0).listPrice);
            goods.remove(items.get(0));
            CashRegister += items.get(0).listPrice;
            System.out.println("CashRegister now: " + CashRegister);

            Item item = items.get(0);
            item.daySold = Day;
            sellList.add(item);

            try {
                Stringed StringedItem = (Stringed) item;
                if (StringedItem.electric) {
                    if (percentage(20)) {
                        Item sellitem;
                        sellitem = goods.stream().filter(s -> s.name.equals("GigBag")).collect(Collectors.toList()).get(0);
                        sell(staff, customerName, Day, sellitem);
                    }
                    if (StringedItem.electric && percentage(25)) {
                        Item sellitem;
                        sellitem = goods.stream().filter(s -> s.name.equals("PracticeAmps")).collect(Collectors.toList()).get(0);
                        sell(staff, customerName, Day, sellitem);
                    }
                    if (percentage(40)) {
                        int n = new Random().nextInt(3);

                        for (int i = 0; i < n; i++) {
                            Item bonnusStrings = goods.stream().filter(s -> s.name.equals("Strings")).collect(Collectors.toList()).get(0);
                            sell(staff, customerName, Day, bonnusStrings);
                        }
                    }
                    if (percentage(30)) {
                        int n = new Random().nextInt(2);

                        for (int i = 0; i < n; i++) {
                            Item bonnusCables = goods.stream().filter(s -> s.name.equals("Cables")).collect(Collectors.toList()).get(0);
                            sell(staff, customerName, Day, bonnusCables);
                        }
                    }
                } else {
                    if (percentage(10)) {
                        Item sellitem;
                        sellitem = goods.stream().filter(s -> s.name.equals("GigBag")).collect(Collectors.toList()).get(0);
                        sell(staff, customerName, Day, sellitem);
                    }
                    if (StringedItem.electric && percentage(15)) {
                        Item sellitem;
                        sellitem = goods.stream().filter(s -> s.name.equals("PracticeAmps")).collect(Collectors.toList()).get(0);
                        sell(staff, customerName, Day, sellitem);
                    }
                    if (percentage(30)) {
                        int n = new Random().nextInt(3);

                        for (int i = 0; i < n; i++) {
                            Item bonnusStrings = goods.stream().filter(s -> s.name.equals("Strings")).collect(Collectors.toList()).get(0);
                            sell(staff, customerName, Day, bonnusStrings);
                        }
                    }
                    if (percentage(20)) {
                        int n = new Random().nextInt(2);

                        for (int i = 0; i < n; i++) {
                            Item bonnusCables = goods.stream().filter(s -> s.name.equals("Cables")).collect(Collectors.toList()).get(0);
                            sell(staff, customerName, Day, bonnusCables);
                        }
                    }
                }

            } catch (Exception e) {

            }

            System.out.println("--------------------------------");
        } else if (percentage(per + 25)) {
            System.out.print("Do customer buy " + items.get(0).name + " with price " + items.get(0).listPrice * 90 / 100 + "? (yes/no): ");
            String option1 = sc.nextLine();
            if (option1.equals("yes")) {
                System.out.println(staff.name + " sold a " + items.get(0).name + " to " + customerName + " for " + items.get(0).listPrice * 90 / 100 + "after a 10% discount.");
                goods.remove(items.get(0));
                CashRegister += items.get(0).listPrice * 90 / 100;
                Item item = items.get(0);
                item.daySold = Day;
                item.listPrice = items.get(0).listPrice * 90 / 100;
                sellList.add(item);
                System.out.println("CashRegister now: " + CashRegister);
                System.out.println("--------------------------------");
            } else {
                System.out.println("Goodbye and see you latter!!");
            }
        }

    }

    //action ocoure since a customer want to sell something
    public void SellingCustomer(Staff staff, String customerName) {
        System.out.print("Item type customer want to sell: ");
        Scanner sc = new Scanner(System.in);
        String name = sc.nextLine();
        if (name.endsWith("Clothing") || name.endsWith("Hats") || name.endsWith("Shirts") || name.endsWith("Bandanas")) {
            System.out.println("We stop selling clothes so we cannot buy it. ");
            System.out.println("--------------------------------");
            return;
        }
        System.out.print("Condition of the item(poor, fair, good, very good, or excellent): ");
        String condition = sc.nextLine();
        System.out.print("Price of the item: ");
        double price = sc.nextDouble();
        System.out.print("New or used:");
        String newOrUsed = new Scanner(System.in).nextLine();
//        System.out.print("Do customer sell " + name + " with price " + price + "? (yes/no): ");
//        String option = new Scanner(System.in).nextLine();
        Item item = new Item();
        item.name = name;
        item.condition = condition;
        item.purchasePrice = price;
        item.newOrUsed = newOrUsed;
        item.listPrice = item.purchasePrice * 2;

        if (percentage(50)) {
            System.out.println(staff.name + " bought a " + condition + " condition " + newOrUsed + " " + name + " from " + customerName + " for $" + price);
            goods.add(item);
            boughtList.add(item);
            CashRegister -= price;
            System.out.println("CashRegister now: " + CashRegister);
            System.out.println("--------------------------------");
        } else if (percentage(75)) {
//            System.out.print("Do customer sell " + name + " with price " + price * 110 / 100 + "? (yes/no): ");
//            String option1 = new Scanner(System.in).nextLine();

            System.out.println(staff.name + " bought a " + condition + " condition " + newOrUsed + " " + name + " from " + customerName + " for $" + price * 1.1);
            item.purchasePrice = price * 1.1;
            item.listPrice = item.purchasePrice * 2;
            goods.add(item);
            CashRegister -= item.purchasePrice;
            boughtList.add(item);
            System.out.println("CashRegister now: " + CashRegister);
            System.out.println("--------------------------------");

        } else {
            System.out.println("Goodbye and see you latter!!");
        }
    }

    public void OpenTheStore() {
        System.out.println("Total number of items sold: " + sellList.size());
        System.out.println("--------------------------------");
        System.out.println("Total number of items purcharse: " + boughtList.size());
        System.out.println("--------------------------------");
    }

    //When staff dammage an item this action will start
    public void DamageAnItem(Staff staff, Item item) {
        goods.remove(item);
        damageList.add(item);
        //its condition is lowered one level
        if (item.condition.equals("poor")) {
            System.out.println(staff.name + "dammaged a " + item.name + "in Poor condition, it is removed from inventory");
            return;
        }
        if (item.condition.equals("excellent")) {
            item.condition = "very good";
        } else if (item.condition.equals("very good")) {
            item.condition = "good";
        } else if (item.condition.equals("good")) {
            item.condition = "fair";
        } else if (item.condition.equals("fair")) {
            item.condition = "poor";
        }
        //listPrice is reduced 20%
        item.listPrice = item.listPrice * 0.8;
        goods.add(item);
        System.out.println(staff.name + " dammaged a " + item.name + " so now listPrice is: " + item.listPrice + " and condition: " + item.condition);

    }

    //Clean the store action
    public void CleanTheStore(Staff staff) {
        int a = new Random().nextInt(100);

        //Velma damages a random item in inventory 5% of the time. Shaggy damages a random item 20% of the time
        if ((a <= 20 && staff.name.equals("Shaggy")) || (a <= 5 && staff.name.equals("Velma"))) {
            int index = new Random().nextInt(goods.size());

            Item item = goods.get(index);
            DamageAnItem(staff, item);
            System.out.println("--------------------------------");
        }
    }

    //Leave the store action
    public void LeaveTheStore(Staff staff) {
        System.out.println("Total number of damage Item: " + damageList.size());
        System.out.println("--------------------------------");
        System.out.println(staff.name + " lock up and leave the store");
        System.out.println("--------------------------------");
    }

    public void stopSellingClothes(List<Item> list) {
        for (int i = 0; i < list.size(); i++) {
            try {
                Clothing ci = (Clothing) list.get(i);
                list.remove(i);
            } catch (Exception e) {

            }
        }

    }

    //random the percentage
    public boolean percentage(int n) {
        int i = new Random().nextInt(100);
        if (i < n) {
            return true;
        }
        return false;
    }

    public void writeToFile(String filename, String text) {
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

    public SubjectLogger CreateLogger() {
        SubjectLogger account = new SubjectLogger();
        account.attach(new Logger());

        return account;
    }
    
    public void run(){
         CD cd = new CD();
        cd.purchasePrice = 10;
        cd.listPrice = cd.purchasePrice * 2;
        cd.dayArrived = 0;
        cd.condition = "excellent";
        goods.add(cd);
        goods.add(cd);
        goods.add(cd);

        Shirts shirts = new Shirts();
        shirts.purchasePrice = 40;
        shirts.listPrice = shirts.purchasePrice * 2;
        shirts.dayArrived = 0;
        shirts.condition = "excellent";
        goods.add(shirts);
        goods.add(shirts);
        goods.add(shirts);

        Guitar guitar = new Guitar();
        guitar.purchasePrice = 50;
        guitar.listPrice = guitar.purchasePrice * 2;
        guitar.dayArrived = 0;
        guitar.condition = "excellent";
        goods.add(guitar);
        goods.add(shirts);
        goods.add(shirts);

        Clerk Shaggy = new Clerk();
        Shaggy.name = "Shaggy";
        Clerk Velma = new Clerk();
        Velma.name = "Velma";

        List<Staff> staffs = new ArrayList<Staff>();
        staffs.add(Velma);
        staffs.add(Shaggy);

        Clerk Daphne = new Clerk();
        staffs.add(Daphne);

        stopSellingClothes(goods);

        //Observe pattern
        Subject subject = new Subject();

        Observer observer1 = new Observer() {
            @Override
            public void ArriveAtStore(Staff staff) {
                ArriveAtStore(staff);
            }

            @Override
            public void CheckRegister(Staff staff) {
                //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
                System.out.println(staff.name + " inform that the insufficient money in the register is " + CashRegister);
                System.out.println("--------------------------------");
            }

            @Override
            public void GoToBank(Staff staff) {
                //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
                GoToBank(staff);
            }

            @Override
            public void DoInventory(Staff staff) {
                //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
                DoInventory(staff);
            }

            @Override
            public void PlaceAnOrder(Staff staff) {
                //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
                //main.PlaceAnOrder(staff, item);
            }

            @Override
            public void OpenTheStore(Staff staff) {
                throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
            }

            @Override
            public void CleanTheStore(Staff staff) {
                throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
            }

            @Override
            public void LeaveTheStore(Staff staff) {
                throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
            }
        };

        //start with 30 days
        for (int n = 1; n <= 30; n++) {
            System.out.println("Day " + n);
            Staff todayStaff = StaffReport(staffs);

            while (percentage(10)) {
                System.out.println(todayStaff.name + " is sick today");
                System.out.println("--------------------------------");
                todayStaff = StaffReport(staffs);
            }
            todayStaff.report();;
            if (CheckRegister(todayStaff)) {
                GoToBank(todayStaff);
            }
            DoInventory(todayStaff);
            MP3 mp3 = new MP3();
            mp3.name = "mp3";
            mp3.condition = "excellent";
            mp3.purchasePrice = 45;
            mp3.listPrice = mp3.purchasePrice * 2;
            PlaceAnOrder(todayStaff, mp3);
            PlaceAnOrder(todayStaff, mp3);
            PlaceAnOrder(todayStaff, mp3);

            Hats hats = new Hats();
            hats.name = "hat";
            hats.condition = "excellent";
            hats.purchasePrice = 10;
            hats.listPrice = hats.purchasePrice * 2;
            hats.setHatSize(35);
            PlaceAnOrder(todayStaff, hats);;
            PlaceAnOrder(todayStaff, hats);
            PlaceAnOrder(todayStaff, hats);

            Bandanas bandanas = new Bandanas();
            bandanas.name = "bandanas";
            bandanas.purchasePrice = 30;
            bandanas.listPrice = bandanas.purchasePrice * 2;
            bandanas.condition = "excellent";

            PlaceAnOrder(todayStaff, bandanas);
            PlaceAnOrder(todayStaff, bandanas);
            PlaceAnOrder(todayStaff, bandanas);
            ArriveAtStore(todayStaff);
            OpenTheStore();
            int sell = new Random().nextInt(4);
            for (int i = 1; i <= sell; i++) {
                System.out.print("Name of customer: ");
                String name = new Scanner(System.in).nextLine();
                SellingCustomer(todayStaff, name);
            }
            Random r = new Random();
            int buy = r.nextInt((10 - 4) + 1) + 4;
            for (int i = 1; i <= sell; i++) {
                System.out.print("Name of customer: ");
                String name = new Scanner(System.in).nextLine();
                BuyingCustomer(todayStaff, name, n);
            }

            CleanTheStore(todayStaff);
            LeaveTheStore(todayStaff);

            LogSubject logSubject = CreateLogger();
            logSubject.notifyAllObserver();
            writeToFile("Logger-" + n, Logger.logText);
            Logger.logText = "";

            System.out.println("Clerk		Items Sold	Items Purchased 	Items Damaged");
            System.out.print(todayStaff.name + "\t");
            System.out.print(sellList.size() + "\t");
            System.out.print(boughtList.size() + "\t");
            System.out.print(damageList.size() + "\t");
            sellList = new ArrayList<>();
            boughtList = new ArrayList<>();
            damageList = new ArrayList<>();
        }

        System.out.println("The items left in inventory:");
        double totalPurcharsePrice = 0;
        for (Item i : goods) {
            System.out.println(i.name + ", condtion: " + i.condition + ", purchasePrice: " + i.purchasePrice);
            totalPurcharsePrice += i.purchasePrice;
        }
        System.out.println("Their total value: " + totalPurcharsePrice);
        System.out.println("--------------------------------");
        double totalSoldPrice = 0;

        System.out.println("The items sold: ");
        for (Item i : sellList) {
            System.out.println(i.name + ", daySold: " + i.daySold + ", price: " + i.listPrice);
            totalSoldPrice += i.purchasePrice;
        }
        System.out.println("--------------------------------");
        System.out.println("Total sell value: " + totalSoldPrice);
        System.out.println("The final count of money in the Cash Register: " + CashRegister);
        System.out.println("The money was added to the register from the GoToBank Action: " + dept);
    }
}
