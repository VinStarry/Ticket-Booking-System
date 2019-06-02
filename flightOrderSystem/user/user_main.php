<?php
include_once '../common/config.php';
include_once '../common/DBConnector.php';
include_once 'user_functions.php';

error_reporting(E_ALL & E_STRICT);

echo "successfully! <br />";
echo $_POST["username"] . "<br />";
echo $_POST["password"] . "<br />";
//echo $_POST["login"] . "<br />";

//$conn = new DBConnector(false);
//try {
//    $user = User_functions::login_account($conn->link, 60001, 'tonybrown911');
////    User_functions::cancel_ticket($conn->link, $user, 120003);
////    User_functions::take_ticket($conn->link, $user, 120001);
////    User_functions::lookup_history($conn->link, $user);
////    User_functions::add_balance($conn->link, $user, "5000.00");
////    User_functions::order_tickets($conn->link, $user, 351, 'E', "2019-6-12 12:35:00");
////    User_functions::pay_for_orders($conn->link, $user, 90002);
//}
//catch (mysqli_sql_exception $ex) {
//    echo $ex;
//}
//catch (user_exception $ex) {
//    echo $ex;
//}
//catch (Exception $ex) {
//    echo $ex;
//}
//echo "$user->UID : $user->UName : $user->UTelephone : $". $user->getUBalance() . "<br />"
//User_functions::search_tickets("2019-05-02", "上海", "北京");
//User_functions::add_balance($conn->link, $user, '500');

?>