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
public class Buy implements StoreCommnand{
    Receiver receiver = new Receiver();
    private FNMS fnms;
    private Staff staff;

    public Buy(FNMS fnms, Staff staff) {
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
        receiver.Buy(fnms, staff);;
    }
}
