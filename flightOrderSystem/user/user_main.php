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
<style type="text/css">
    .demo{width:760px; margin:20px auto 0 auto; height:70px;}
    .button {
        display: inline-block;
        outline: none;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        font: 16px/100% 'Microsoft yahei',Arial, Helvetica, sans-serif;
        padding: .5em 2em .55em;
        text-shadow: 0 1px 1px rgba(0,0,0,.3);
        -webkit-border-radius: .5em;
        -moz-border-radius: .5em;
        border-radius: .5em;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        box-shadow: 0 1px 2px rgba(0,0,0,.2);
    }
    .button:hover {
        text-decoration: none;
    }
    .button:active {
        position: relative;
        top: 1px;
    }
    .bigrounded {
        -webkit-border-radius: 2em;
        -moz-border-radius: 2em;
        border-radius: 2em;
    }
    .medium {
        font-size: 12px;
        padding: .4em 1.5em .42em;
    }
    .small {
        font-size: 11px;
        padding: .2em 1em .275em;
    }


    /* blue */
    .blue {
        color: #d9eef7;
        border: solid 1px #0076a3;
        background: #0095cd;
        background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
        background: -moz-linear-gradient(top,  #00adee,  #0078a5);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
    }
    .blue:hover {
        background: #007ead;
        background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
        background: -moz-linear-gradient(top,  #0095cc,  #00678e);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
    }
    .blue:active {
        color: #80bed6;
        background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
        background: -moz-linear-gradient(top,  #0078a5,  #00adee);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
    }

    /* green */
    .green {
        color: #e8f0de;
        border: solid 1px #538312;
        background: #64991e;
        background: -webkit-gradient(linear, left top, left bottom, from(#7db72f), to(#4e7d0e));
        background: -moz-linear-gradient(top,  #7db72f,  #4e7d0e);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#7db72f', endColorstr='#4e7d0e');
    }
    .green:hover {
        background: #538018;
        background: -webkit-gradient(linear, left top, left bottom, from(#6b9d28), to(#436b0c));
        background: -moz-linear-gradient(top,  #6b9d28,  #436b0c);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#6b9d28', endColorstr='#436b0c');
    }
    .green:active {
        color: #a9c08c;
        background: -webkit-gradient(linear, left top, left bottom, from(#4e7d0e), to(#7db72f));
        background: -moz-linear-gradient(top,  #4e7d0e,  #7db72f);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#4e7d0e', endColorstr='#7db72f');
    }

    /* white */
    .white {
        color: #606060;
        border: solid 1px #b7b7b7;
        background: #fff;
        background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));
        background: -moz-linear-gradient(top,  #fff,  #ededed);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
    }
    .white:hover {
        background: #ededed;
        background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#dcdcdc));
        background: -moz-linear-gradient(top,  #fff,  #dcdcdc);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dcdcdc');
    }
    .white:active {
        color: #999;
        background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#fff));
        background: -moz-linear-gradient(top,  #ededed,  #fff);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ffffff');
    }

    /* orange */
    .orange {
        color: #fef4e9;
        border: solid 1px #da7c0c;
        background: #f78d1d;
        background: -webkit-gradient(linear, left top, left bottom, from(#faa51a), to(#f47a20));
        background: -moz-linear-gradient(top,  #faa51a,  #f47a20);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#faa51a', endColorstr='#f47a20');
    }
    .orange:hover {
        background: #f47c20;
        background: -webkit-gradient(linear, left top, left bottom, from(#f88e11), to(#f06015));
        background: -moz-linear-gradient(top,  #f88e11,  #f06015);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f88e11', endColorstr='#f06015');
    }
    .orange:active {
        color: #fcd3a5;
        background: -webkit-gradient(linear, left top, left bottom, from(#f47a20), to(#faa51a));
        background: -moz-linear-gradient(top,  #f47a20,  #faa51a);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f47a20', endColorstr='#faa51a');
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
    <form method="post", action="order_ticket.php">
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
        <input name="signupok" type="submit" value="OK"/>
        <p>
        <div style="text-align: center">
            <?php session_start();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $src_city = test_input($_POST["src_city"]);
                $dst_city = test_input($_POST["des_city"]);
                $in_date =  test_input($_POST["in_date"]);
                $signupok = test_input($_POST["signupok"]);
                $uname = test_input($_SESSION["UID"]);
                $upsw = test_input($_SESSION["PSW"]);
                $order_b = test_input($_POST["order_b"]);

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
