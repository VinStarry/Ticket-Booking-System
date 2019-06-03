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
<div style="text-align: center; vertical-align: center; margin-top: 200px;" >
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>
            付款/取票/退票模块
        </p>
        <p>
            账  户：<input type="text" name="username"/>
        </p>
        <p>
            密  码：<input type="password" name="password"/>
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
        <input name="order_button" type="submit" value="确定"/>
        <p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = test_input($_POST["username"]);
                $order_button = test_input($_POST["order_button"]);
                $password = test_input($_POST["password"]);
                $otid = test_input($_POST["otid"]);
                $sel = test_input($_POST["q"]);
                $conn = new DBConnector(false);
//                echo "$username, $order_button, $otid, $sel";
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
//                                echo "<script language=javascript>alert('退票成功');</script>";
                            }
                            else {
                                echo "<script language=javascript>alert('请选择一项操作');</script>";
                            }
                        }
//                        else {
//                            $usr = User_functions::login_account($conn->link, $username, $password);
//
//                            echo "<div style=\"text-align: center\">";
//                            echo "<table border=\"2\" align='center'>
//                        <tr>
//                        <th>订单号</th>
//                        <th>用户编号</th>
//                        <th>购票时间</th>
//                        <th>是否付款</th>
//                        <th>订单花费</th>
//                        <th>机票编号</th>
//                        <th>是否取消</th>
//                        <th>取票时间</th>
//                        <th>起飞时间</th>
//                        <th>飞机编号</th>
//                        <th>座舱等级</th>
//                        <th>机票花费</th>
//                        </tr>
//                        ";
//                            for ($i = 0; $i < count($ret); $i++) {
//                                $temp = $ret[$i];
//                                echo "<tr>";
//                                for ($j = 0; $j < count($temp); $j++) {
//                                    echo "<th>".$temp[$j] . "</th>";
//                                }
//                                echo "</tr>";
//                            }
//                            echo "</table>";
//                            echo "</div>";
//                        }
                    }
                    catch (user_exception $ex) {
                        echo "<script language=javascript>alert('$ex');</script>";
                    }
                    catch (mysqli_sql_exception $ex) {
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