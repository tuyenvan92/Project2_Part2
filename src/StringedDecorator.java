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
public class StringedDecorator implements IStringed{
    public IStringed istring;

    public StringedDecorator(IStringed istring) {
        this.istring = istring;
    }

    public IStringed getIstring() {
        return istring;
    }

    public void setIstring(IStringed istring) {
        this.istring = istring;
    }
    
}
