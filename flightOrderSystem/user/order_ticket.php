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
    $fid = test_input($_POST["fid"]);
    $order_button = test_input($_POST["order_button"]);
    $in_date = test_input($_POST["in_date"]);
    $seatclass = (string)test_input($_POST["q"]);
    $conn = new DBConnector(false);
//    echo "$username, $fid, $order_button, $seatclass, $in_date";
    if (!strcmp($order_button, "预订")) {
        try {
            $user = User_functions::login_account($conn->link, (int)$username, $password);
            if (!is_numeric($username)) {
                echo "<script language=javascript>alert('账户必须是全数字!');</script>";
            }
            if (!is_numeric($fid)) {
                echo "<script language=javascript>alert('飞机编号必须是全数字!');</script>";
            }
            else {
                $offtime = User_functions::get_flying_time($conn->link, $fid);
                if ($offtime == null) {
                    echo "<script language=javascript>alert('不存在这个飞机编号!');</script>";
                }
                else {
                    $offdatetime = $in_date." ".$offtime;
                    User_functions::order_tickets($conn->link, $username, $fid, $seatclass, $offdatetime);
                    echo "<script language=javascript>alert('订票成功!');</script>";
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
            欢迎登陆机票预订系统
        </p>
        <p>
            账  户：<input type="text" name="username"/>
        </p>
        <p>
            飞机编号：<input type="text" name="fid"/>
        </p>
        <p>
            座位类型: <input type="radio" name="q" value="E" />E
                     <input type="radio" name="q" value="C" />C
                     <input type="radio" name="q" value="F" />F
        </p>
        <p>
            出发时间：<input type="date" name="in_date"/>
        </p>
        <input name="order_button" type="submit" value="预订"/>
    </form>
</body>
</div>
</html>