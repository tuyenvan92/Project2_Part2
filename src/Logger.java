/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package fnms;

import java.io.FileNotFoundException;
import java.io.OutputStream;
import java.io.PrintStream;

/**
 *
 * @author ADMIN
 */
public class Logger implements LogObserver {
 
    public static String logText = "";

    @Override
    public void Log(String s) {
        logText+=s;
    }
}