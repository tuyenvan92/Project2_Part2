/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package fnms;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.Scanner;

/**
 *
 * @author ADMIN
 */
public class Receiver {

    public Receiver() {
    }

    public void selectStore() {
        System.out.println("Please select store nothsite or southsite: ");
        System.out.println("1: Southsite: ");
        System.out.println("2: Northsite: ");
        Scanner sc = new Scanner(System.in);

    }

    public void AskCleakName(Staff clerk) {
        System.out.println("Cleak name: " + clerk.name);
    }

    public void AskTime() {
        DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyy/MM/dd HH:mm:ss");
        LocalDateTime now = LocalDateTime.now();
        System.out.println(dtf.format(now));
    }

    public void Sell(FNMS fnms, Staff staff,int Day) {
        System.out.println("Please enter customer name: ");
        Scanner sc = new Scanner(System.in);
        String customerName = sc.nextLine();
        fnms.BuyingCustomer(staff,  customerName, Day);
    
    }

    public void Buy(FNMS fnms, Staff staff) {
        System.out.println("Please enter customer name: ");
        Scanner sc = new Scanner(System.in);
        String customerName = sc.nextLine();
        fnms.SellingCustomer(staff,  customerName);
    }
    public void SellGuitar(FNMS fnms,Staff staff){
        Item item = new Item();
        item.name = "Guitar";
        this.Sell(fnms, staff, 0);
    }
}
