<html>
<body>
<?php
include_once '../common/config.php';
include_once '../common/DBConnector.php';
include_once 'user_functions.php';
$username = $password = $signup = $login = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div style="text-align: center; vertical-align: center; margin-top: 100px" >
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>
            查看历史订票记录模块
        </p>
        <p>
            账  户：<input type="text" name="username"/>
        </p>
        <p>
            密  码：<input type="password" name="password"/>
        </p>
        <input name="order_button" type="submit" value="查看"/>
        <p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = test_input($_POST["username"]);
                $order_button = test_input($_POST["order_button"]);
                $password = test_input($_POST["password"]);
                $conn = new DBConnector(false);
//    echo "$username, $order_button, $balance";
                if (!strcmp($order_button, "查看")) {
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
                }
            }
            ?>
        </p>
    </form>
</body>
</div>
</html>