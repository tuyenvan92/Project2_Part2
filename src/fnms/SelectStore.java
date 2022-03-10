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
public class SelectStore implements StoreCommnand{
    Receiver receiver = new Receiver();
    @Override
    public void execute() {
       receiver.selectStore();
    }
    
}
