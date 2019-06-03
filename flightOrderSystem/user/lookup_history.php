<html>
<body>
<?php session_start();
include_once '../common/config.php';
include_once '../common/DBConnector.php';
include_once 'user_functions.php';
$username = $_SESSION['UID'];
$password = $_SESSION['PSW'];

$conn = new DBConnector(false);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div style="text-align: center; vertical-align: center; margin-top: 100px" >
    <form method="post" action="lookup_history.php">
        <p>
            付款/取票/退票模块
        </p>
        票/单号:<input type="text" name="otid"/>
        <p>
        <p>
            选  项: <input type="radio" name="q" value="pay" />付款
            <input type="radio" name="q" value="take" />取票
        </p>
        <p>
            <input type="radio" name="q" value="cancel" />退票
        </p>
        </p>
        <input name="option" type="submit" value="返回"/>
        <input name="obutton" type="submit" value="确定"/>
        <?php
        try {
            $user = User_functions::login_account($conn->link, (int)$username, $password);
            $ubalance = $user->getUBalance();
            echo "<div style=\"text-align: center\">";
            echo "<table border=\"2\" align='center'>
                        <tr>
                        <th>用户编号</th>
                        <th>用户名称</th>
                        <th>用户电话</th>
                        <th>用户余额</th>
                        <tr>
                        <th>$user->UID</th>
                        <th>$user->UName</th>
                        <th>$user->UTelephone</th>
                        <th>$ubalance</th>
                        </tr>";
            echo "</table>";
            echo "</div><p />";
            if (!is_numeric($username)) {
                echo "<script language=javascript>alert('账户必须是全数字!');</script>";
            }
            else {
                $usr = User_functions::login_account($conn->link, $username, $password);
                $ret = User_functions::lookup_history($conn->link, $usr);

                echo "<div style=\"text-align: center\">";
                echo "<table border=\"2\" align='center'>
                        <tr>
                        <th>订单号</th>
                        <th>用户编号</th>
                        <th>购票时间</th>
                        <th>是否付款</th>
                        <th>订单花费</th>
                        <th>机票编号</th>
                        <th>是否取消</th>
                        <th>取票时间</th>
                        <th>起飞时间</th>
                        <th>飞机编号</th>
                        <th>座舱等级</th>
                        <th>机票花费</th>
                        </tr>
                        ";
                for ($i = 0; $i < count($ret); $i++) {
                    $temp = $ret[$i];
                    echo "<tr>";
                    for ($j = 0; $j < count($temp); $j++) {
                        echo "<th>".$temp[$j] . "</th>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
        }
        catch (user_exception $ex) {
            echo "<script language=javascript>alert('$ex');</script>";
        }
        catch (mysqli_sql_exception $ex) {
            echo "<script language=javascript>alert('$ex');</script>";
        }
        catch (Exception $ex) {
            echo "<script language=javascript>alert('$ex');</script>";
        }
        ?>
        <p>
            <?php
            session_start();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = test_input($_SESSION['UID']);
                $password = test_input($_SESSION['PSW']);
                $order_button = test_input($_POST["obutton"]);
                $option = test_input($_POST["option"]);
                $otid = test_input($_POST["otid"]);
                $sel = test_input($_POST["q"]);
                $conn = new DBConnector(false);
                echo "$username, $order_button, $option";
                if (!strcmp($order_button, "确定")) {
                    try {
                        $user = User_functions::login_account($conn->link, (int)$username, $password);
                        if (!is_numeric($username)) {
                            echo "<script language=javascript>alert('账户必须是全数字!');</script>";
                        }
                        else if (!is_numeric($otid)) {
                            echo "<script language=javascript>alert('票/单号必须是全数字!');</script>";
                        }
                        else {
                            if (!strcmp($sel, "pay")) {
                                User_functions::pay_for_orders($conn->link, $user, $otid);
                                echo "<script language=javascript>alert('付费成功');</script>";
                            }
                            else if (!strcmp($sel, "take")) {
                                User_functions::take_ticket($conn->link, $user, $otid);
                                echo "<script language=javascript>alert('取票成功');</script>";
                            }
                            else if (!strcmp($sel, "cancel")) {
                                User_functions::cancel_ticket($conn->link, $user, $otid);
                                echo "<script language=javascript>alert('退票成功');</script>";
                            }
                            else {
                                echo "<script language=javascript>alert('请选择一项操作');</script>";
                            }
                        }
                    }
                    catch (user_exception $ex) {
                        echo "<script language=javascript>alert('$ex');</script>";
                    }
                    catch (mysqli_sql_exception $ex) {
                        echo "<script language=javascript>alert('$ex');</script>";
                    }
                    finally {
                        $url = "lookup_history.php";
                        echo "<script language=javascript>location.href='$url'</script>";
                    }
                }
                else if (!strcmp($option, "返回")){
                    echo  "2";
                    $url = "user_main.php";
                    echo "<script language=javascript>location.href='$url'</script>";
                }
            }

            ?>
        </p>
    </form>
</body>
</div>
</html>