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
public interface Observer {

    public void ArriveAtStore(Staff staff);

    public void CheckRegister(Staff staff);

    public void GoToBank(Staff staff);

    public void DoInventory(Staff staff);

    public void PlaceAnOrder(Staff staff);

    public void OpenTheStore(Staff staff);

    public void CleanTheStore(Staff staff);

    public void LeaveTheStore(Staff staff);

}
