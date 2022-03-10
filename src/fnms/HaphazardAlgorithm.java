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
public class HaphazardAlgorithm implements TuneAlgorithm {

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

    public HaphazardAlgorithm(Clerk clerk, Item item) {
        this.clerk = clerk;
        this.item = item;
    }

    @Override
    public Item go(Staff staff, Item item) {
        if (main.percentage(50)) {
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
                p1.tuned = !p.tuned;
                item = p1;
            } catch (Exception e) {
                //return this.item;
            }
            try {
                 Wind p = (Wind ) item;
                Wind p1 = p;
                p1.adjusted = !p.adjusted;
                item = p1;
            } catch (Exception e) {
                //return this.item;
            }
        }

        return this.item;

    }

}
