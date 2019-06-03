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
$username = $password = $signup = $login = "";
$in_date = test_input($_POST["in_date"]);
$src_city = $_POST['src_city'] ;
$dst_city = $_POST['dst_city'];

//echo "$in_date, $src_city, $dst_city";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_SESSION['UID']);
    $fid = test_input($_POST["fid"]);
    $in_date = test_input($_POST["in_date"]);
    $src_city = $_POST['src_city'] ;
    $dst_city = $_POST['dst_city'];
    $order_button = test_input($_POST["order_button"]);
    $seatclass = (string)test_input($_POST["q"]);
    $conn = new DBConnector(false);
    $option = $_POST['option'];
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
        finally {
            $url = "user_main.php";
            echo "<script language=javascript>location.href='$url'</script>";
        }
    }
    else if (!strcmp($option, "返回")) {
        $url = "user_main.php";
        echo "<script language=javascript>location.href='$url'</script>";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div style="text-align: center;margin-top: 100px">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>
            欢迎登陆机票预订系统
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
        <p>
        <input name="order_button" type="submit" value="预订"/>
            <input name="option" type="submit" value="返回"/>
        </p>
        <div style="text-align: center;margin-left: 130px">
        <p>
            <?php session_start();
            $ret = User_functions::search_tickets($in_date, $src_city, $dst_city);
            echo "<table border=\"2\">
            <tr>
                <th>飞机编号</th>
                <th>机型</th>
                <th>出发机场</th>
                <th>目的机场</th>
                <th>出发日期</th>
                <th>出发时间</th>
                <th>降落时间</th>
                <th>经济舱价格</th>
                <th>商务舱价格</th>
                <th>头等舱价格</th>
                <th>经济舱余票</th>
                <th>商务舱余票</th>
                <th>头等舱余票</th>
            </tr>
            ";
            for ($i = 0; $i < count($ret); $i++) {
                $temp = $ret[$i];
                echo "<tr>";
                for ($j = 0; $j < count($temp); $j++) {
                    echo"<td>$temp[$j]</td>";
                }
                echo "</tr>";
            }
            ?>
        </p>
        </div>
    </form>
</body>
</div>
</html>