/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package fnms;

import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author ADMIN
 */
public class Subject {

    private List<Observer> observers = new ArrayList<Observer>();

    public void attach(Observer observer) {
        observers.add(observer);
    }

    public void detach(Observer observer) {
        observers.remove(observer);
    }

    public void CheckRegister(Staff staff) {
        for (Observer observer : observers) {

            observer.CheckRegister(staff);
        }
    }

    public void GoToBank(Staff staff) {
        for (Observer observer : observers) {

            observer.GoToBank(staff);
        }
    }

    public void DoInventory(Staff staff) {
        for (Observer observer : observers) {

            observer.DoInventory(staff);
        }
    }

    public void PlaceAnOrder(Staff staff) {
        for (Observer observer : observers) {

            observer.PlaceAnOrder(staff);
        }
    }

    public void OpenTheStore(Staff staff) {
        for (Observer observer : observers) {

            observer.OpenTheStore(staff);
        }
    }

    public void CleanTheStore(Staff staff) {
        for (Observer observer : observers) {

            observer.CleanTheStore(staff);
        }
    }

    public void LeaveTheStore(Staff staff) {
        for (Observer observer : observers) {

            observer.LeaveTheStore(staff);
        }
    }
    
}
