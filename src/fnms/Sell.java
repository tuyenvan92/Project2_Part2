/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package fnms;

/**
 *
 * @author ADMIN
 */
public class Sell implements StoreCommnand{
    Receiver receiver = new Receiver();
    
  
    private FNMS fnms;
    private Staff staff;
    private int Day;

    public Sell(FNMS fnms, Staff staff, int Day) {
        this.fnms = fnms;
        this.staff = staff;
        this.Day = Day;
    }

    public int getDay() {
        return Day;
    }

    public void setDay(int Day) {
        this.Day = Day;
    }

    public Sell(FNMS fnms, Staff staff) {
        this.fnms = fnms;
        this.staff = staff;
    }

    public FNMS getFnms() {
        return fnms;
    }

    public void setFnms(FNMS fnms) {
        this.fnms = fnms;
    }

    public Staff getStaff() {
        return staff;
    }

    public void setStaff(Staff staff) {
        this.staff = staff;
    }
    
    @Override
    public void execute() {
        receiver.Sell(fnms, staff, Day);;
    }
    
}
