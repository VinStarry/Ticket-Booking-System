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
$username = $password = $tel = $signupok = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["in_username"]);
    $password = test_input($_POST["in_password"]);
    $signupok = test_input($_POST["signupok"]);
    $tel = test_input($_POST["in_tel"]);
    $conn = new DBConnector(false);
    if (!strcmp($signupok, "OK")) {
        try {
            $ret = User_functions::create_account($conn->link, $username, $password, $tel);
            if ($ret != -1) {
                echo "<script language=javascript>alert('你的账号是$ret,请一定记住这个账号!');</script>";
                $url="login.php";
                echo "<script language=javascript>location.href='$url'</script>";
            }
            else {
                echo "<script language=javascript>alert('注册失败,可能是服务器正忙,请重试!');</script>";
            }
        }
        catch (user_exception $ex) {
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
            姓  名：<input type="text" name="in_username"/>
        </p>
        <p>
            密  码：<input type="password" name="in_password"/>
        </p>
        <p>
            电  话：<input type="text" name="in_tel"/>
        </p>
        <input name="signupok" type="submit" value="OK"/>
    </form>
    </body>
</div>
</html>