<?php

/* sudo cp -r flightOrderSystem /Library/WebServer/Documents  */

include_once 'admin_functions.php';
include_once '../common/decimal2P.php';

try {
    $admin = new admin_functions();
//    $admin->add_flight(351, 'A330', '12:35:00', 122, 'PEK', 'SHA', '2019-05-01 12:00:00', '2019-10-01 23:00:00', 10, 30, 260);
//    $admin->add_flying_date(351, "2019-05-02", "2019-08-31", 1, "90", "90", "90", "1850.00", "2490.50", "4100.35");
//    $admin->add_flight(350, 'A330', '16:35:00', 121, 'SHA', 'PEK', '2019-05-01 12:00:00', '2019-10-01 23:00:00', 10, 30, 260);
//    $admin->add_flying_date(350, "2019-05-02", "2019-08-31", 1, "90", "90", "90", "1850.00", "2490.50", "4100.35");
//    $admin->add_flight(358, 'B777', '14:55:00', 122, 'PEK', 'PVG', '2019-05-01 12:00:00', '2019-08-01 23:00:00', 15, 32, 280);
//    $admin->add_flying_date(358, "2019-05-02", "2019-07-31", 2, "90", "90", "90", "1900.00", "2500.50", "4400.00");
//    $admin->add_flight(359, 'B777', '19:55:00', 121, 'PVG', 'PEK', '2019-05-01 12:00:00', '2019-08-01 23:00:00', 15, 32, 280);
//    $admin->add_flying_date(359, "2019-05-02", "2019-07-31", 2, "90", "90", "90", "1900.00", "2500.50", "4400.00");
}
catch (mysqli_sql_exception $ex){
    echo $ex . "<br />";
}
catch (admin_exception $ex) {
    echo $ex . "<br />";
}
catch (Exception $ex) {
    echo $ex . "<br />";
}

//try {
//    $admin = new admin_functions();
//    $admin->add_flight(237, 'B777', '14:00:00', 140, 'PVG', 'CAN', '2019-05-01 12:00:00', '2019-08-01 23:00:00', 350,
//    '1800.00', '30', '2458.50', '10', '4500.30');
//    $admin->add_flight(238, 'B777', '18:00:00', 140, 'CAN', 'PVG', '2019-05-01 12:00:00', '2019-08-01 23:00:00', 350,
//        '1800.00', '30', '2458.50', '10', '4500.30');
//}
//catch (mysqli_sql_exception $ex){
//    echo $ex . "<br />";
//}
//catch (admin_exception $ex) {
//    echo $ex . "<br />";
//}

//$a = new decimal2P("0.58");
//$a->multiply(new decimal2P("80"));
//echo $a->showMoney() . "<br />";

//date_default_timezone_set('PRC');
//$dateFormat = "Y-m-d";
//$dateTimeFormat = "Y-m-d H:i:s";
//$date = new DateTime(); echo $date->format($dateTimeFormat) . "\n";