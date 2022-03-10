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
public class ManualAlgorithm implements TuneAlgorithm {

    private Clerk clerk;
    private Item item;

    public Item getItem() {
        return item;
    }

    public void setItem(Item item) {
        this.item = item;
    }

    public Clerk getClerk() {
        return clerk;
    }

    public void setClerk(Clerk clerk) {
        this.clerk = clerk;
    }

    public ManualAlgorithm(Clerk clerk, Item item) {
        this.clerk = clerk;
        this.item = item;
    }

    @Override
    public Item go(Staff staff, Item item) {
        //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.

        try {
            Players p = (Players) item;
            Players p1 = p;
            //p1.equalized = true;
        } catch (Exception e) {
            return this.item;
        }
        try {
            Stringed p = (Stringed) item;
            Stringed p1 = p;
            if (!p.tuned && main.percentage(80)) {
                p1.tuned = !p.tuned;
            }
            if (p.tuned && main.percentage(20)) {
                p1.tuned = !p.tuned;
            }
            item = p1;

        } catch (Exception e) {
            return this.item;
        }
        try {
            Wind w = (Wind) item;
            Wind w1 = w;
            if (!w.adjusted && main.percentage(80)) {
               w1.adjusted = !w.adjusted;
                      
            }
            if (w.adjusted && main.percentage(20)) {
               w1.adjusted = !w.adjusted;
                      
            }
            item = w1;
        } catch (Exception e) {
            
        }
        try {
            Stringed w = (Stringed) item;
            Stringed w1 = w;
            if (!w.tuned && main.percentage(80)) {
                w1.tuned = !w.tuned;
            }
            
            item = w1;
        } catch (Exception e) {
            
        }
        return this.item;
    }

    
    
}
