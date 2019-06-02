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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $order_button = test_input($_POST["order_button"]);
    $password = test_input($_POST["password"]);
    $balance = (string)test_input($_POST["q"]);
    $conn = new DBConnector(false);
//    echo "$username, $order_button, $balance";
    if (!strcmp($order_button, "充值")) {
        try {
            $user = User_functions::login_account($conn->link, (int)$username, $password);
            if (!is_numeric($username)) {
                echo "<script language=javascript>alert('账户必须是全数字!');</script>";
            }
            else {
                $usr = User_functions::login_account($conn->link, $username, $password);
                if (User_functions::add_balance($conn->link, $usr, $balance)) {
                    echo "<script language=javascript>alert('充值' + $balance + '成功');</script>";
                }
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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div class="divForm">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>
            欢迎登陆充值系统
        </p>
        <p>
            账  户：<input type="text" name="username"/>
        </p>
        <p>
            密  码：<input type="password" name="password"/>
        </p>
        <p>
            充值金额: <input type="radio" name="q" value="1000.00" />1000.00
            <input type="radio" name="q" value="2000.00" />2000.00
            <p>
            <input type="radio" name="q" value="5000.00" />5000.00
            <input type="radio" name="q" value="10000.00" />10000.00
            </p>
        </p>
        <input name="order_button" type="submit" value="充值"/>
    </form>
</body>
</div>
</html>