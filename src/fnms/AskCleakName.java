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
public class AskCleakName implements StoreCommnand{
    Receiver receiver = new Receiver();
    private Clerk clerk;

    public AskCleakName(Clerk clerk) {
        this.clerk = clerk;
    }

    public Clerk getClerk() {
        return clerk;
    }

    public void setClerk(Clerk clerk) {
        this.clerk = clerk;
    }
    @Override
    public void execute() {
        receiver.AskCleakName(clerk);
    }
    
}
