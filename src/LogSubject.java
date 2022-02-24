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
public interface LogSubject {

    void attach(LogObserver observer);

    void detach(LogObserver observer);

    void notifyAllObserver();

}
