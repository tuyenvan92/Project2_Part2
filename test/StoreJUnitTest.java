/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import fnms.FNMS;
import fnms.Item;
import fnms.Staff;
import javafx.beans.binding.Bindings;
import org.junit.After;
import org.junit.AfterClass;
import org.junit.Before;
import org.junit.BeforeClass;
import org.junit.Test;
import static org.junit.Assert.*;

/**
 *
 * @author ADMIN
 */
public class StoreJUnitTest {

    fnms.FNMS fnms = new FNMS();

    @Test
    public void test1() {
        assertTrue("Pass test 1", fnms.percentage(100));

    }

    @Test
    public void test2() {
        assertFalse("Pass test 1", fnms.percentage(0));

    }

    @Test
    public void test3() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.CashRegister;
        fnms.GoToBank(staff);
        assertTrue("Test 3", a == fnms.CashRegister - 1000);

    }

    @Test
    public void test4() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.CashRegister;
        fnms.GoToBank(staff);
        assertTrue("Test 3", a == fnms.CashRegister - 1000);

    }

    @Test
    public void test5() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.CashRegister;
        fnms.GoToBank(staff);
        assertTrue("Test 3", fnms.CashRegister > 75);

    }

    @Test
    public void test6() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.CashRegister;
        fnms.ArriveAtStore(staff);
        assertTrue("Test 3", fnms.CashRegister == a);

    }

    @Test
    public void test7() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.CashRegister;
        fnms.ArriveAtStore(staff);
        assertTrue("Test 3", fnms.CashRegister == a);

    }

    @Test
    public void test8() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.CashRegister;
        Item item = new Item();
        fnms.PlaceAnOrder(staff, item);
        assertTrue("Test 3", fnms.CashRegister <= a);

    }

    @Test
    public void test9() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.waitList.size();
        Item item = new Item();
        fnms.PlaceAnOrder(staff, item);
        assertTrue("Test 3", fnms.waitList.size() >= a);

    }

    public void test10() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.waitList.size();
        Item item = new Item();
        fnms.DamageAnItem(staff, item);
        assertTrue("Test 3", fnms.waitList.size() <= a);

    }

    public void test11() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.goods.size();
        Item item = new Item();
        fnms.DamageAnItem(staff, item);
        assertTrue("Test 3", fnms.goods.size() <= a);

    }

    public void test12() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.CashRegister;
        Item item = new Item();
        item.salePrice = 100;
        fnms.sell(staff, "", 0, item);
        assertTrue("Test 3", fnms.CashRegister - item.salePrice == a);

    }

    public void test13() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.goods.size();
        Item item = new Item();
        item.salePrice = 100;
        fnms.stopSellingClothes(fnms.goods);
        assertTrue("Test 3", fnms.goods.size() <= a);

    }

    public void test14() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.goods.size();
        Item item = new Item();
        item.salePrice = 100;
        fnms.sell(staff, "", 0, item);
        assertTrue("Test 3", fnms.goods.size() <= a);

    }

    public void test15() {
        //assertFalse("Pass test 1", fnms.percentage(0));
        Staff staff = new Staff();
        double a = fnms.damageList.size();
        Item item = new Item();
        item.salePrice = 100;
        fnms.DamageAnItem(staff, item);
        assertTrue("Test 3", fnms.damageList.size()>= a);

    }
    // TODO add test methods here.
    // The methods must be annotated with annotation @Test. For example:
    //
    // @Test
    // public void hello() {}
}
