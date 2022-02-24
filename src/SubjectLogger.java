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
public class SubjectLogger implements LogSubject {

    private String logText;
    private List<LogObserver> observers = new ArrayList<>();

    @Override
    public void attach(LogObserver observer) {
        if (!observers.contains(observer)) {
            observers.add(observer);
        }
    }

    @Override
    public void detach(LogObserver observer) {
        if (observers.contains(observer)) {
            observers.remove(observer);
        }
    }

    @Override
    public void notifyAllObserver() {
        for (LogObserver observer : observers) {
            observer.Log(logText);
        }
    }

}
