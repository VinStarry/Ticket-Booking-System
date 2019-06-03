<style type="text/css">
    .divForm{
        position: absolute;/*绝对定位*/
        width: 300px;
        height: 200px;

        border: 1px solid red;
        text-align: center;/*(让div中的内容居中)*/
        top: 50%;
        left: 50%;
        margin-top: -200px;
        margin-left: -150px;
    }
</style>
<html>
    <body>
<?php session_start();
include_once '../common/config.php';
include_once '../common/DBConnector.php';
include_once 'user_functions.php';

$uname = test_input($_SESSION["UID"]);
$upsw =  test_input($_SESSION["PSW"]);
$src_city = $dst_city = "";
$conn = new DBConnector(false);
$city_arr = array_unique($conn->get_city_from_code("", true));

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="divForm">
    <form method="post", action="choose_file.php">
        <p>
                机票预订功能块
        </p>
        <p>
            出发城市：<select name="src_city">
                <?php
                foreach ($city_arr as $city) {
                    echo "<option value = $city>$city</option>";
                }
                ?>
            </select>
        </p>
        <p>
            目的城市：<select name="des_city">
                <?php
                foreach ($city_arr as $city) {
                    echo "<option value = $city>$city</option>";
                }
                ?>
            </select>
        </p>
        <p>
            出发时间：<input type="date" name="in_date"/>
        </p>
        <input name="option" type="submit" value="查票"/>
        <input name="option" type="submit" value="充值"/>
        <input name="option" type="submit" value="历史"/>
        <p>
        <div style="text-align: center">
            <?php session_start();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $src_city = test_input($_POST["src_city"]);
                $dst_city = test_input($_POST["des_city"]);
                $in_date =  test_input($_POST["in_date"]);
                $signupok = test_input($_POST["signupok"]);
                $signupok2 = test_input($_POST["signupok2"]);
                $uname = test_input($_SESSION["UID"]);
                $upsw = test_input($_SESSION["PSW"]);

                $seatclass = test_input($_POST["q"]);

                try {
                    if (!strcmp($signupok, "OK")) {
                        echo "$uname, $in_date, $signupok, $src_city, $dst_city <br >";
                        $_SESSION['UID'] = $uname;
                        $_SESSION['INDATE'] = $in_date;
                        $_SESSION['FROMP'] = $src_city;
                        $_SESSION['TOP'] = $dst_city;
                        $url = "order_ticket.php";
                        echo "<script language=javascript>location.href='$url'</script>";
                    }
                }
                catch (mysqli_sql_exception $ex) {
                    echo "<script language=javascript>alert('$ex');</script>";
                }
                catch (user_exception $ex) {
                    echo "<script language=javascript>alert('$ex');</script>";
                }
                catch (Exception $ex) {
                    echo "<script language=javascript>alert('$ex');</script>";
                }
            }
            ?>
        </div>
        </p>
    </form>
    </body>
    </div>

</html>

<?php
//echo "successfully! <br />";
//echo $_POST["username"] . "<br />";
//echo $_POST["password"] . "<br />";
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
<?php
//    echo "$uname, $upsw <br />";
//    try {
//        $user = User_functions::login_account($conn->link, $uname, $upsw);
//        if($user == null) {
//            echo "<script language=javascript>alert('登录失败');</script>";
//        }
//        else {
//            echo "<script language=javascript>alert('登录成功');</script>";
//        }
//    }
//    catch (mysqli_sql_exception $ex) {
//        echo "<script language=javascript>alert('$ex');</script>";
//    }
//    catch (user_exception $ex) {
//        echo "<script language=javascript>alert('$ex');</script>";
//    }
//    catch (Exception $ex) {
//        echo "<script language=javascript>alert('$ex');</script>";
//    }
?>
