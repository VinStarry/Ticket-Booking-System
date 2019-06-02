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
    $password = test_input($_POST["password"]);
    $signup = test_input($_POST["signup"]);
    $login = test_input($_POST["login"]);
    $conn = new DBConnector(false);
    if (!strcmp($login, "登录")) {
        try {
            $user = User_functions::login_account($conn->link, (int)$username, $password);
            if ($user == null) {
                echo "<script language=javascript>alert('密码错误!');</script>";
            }
            else {
//                $url="user_main.php";
//                echo "<script language=javascript>location.href='$url'</script>";
                echo " <form style='display:none;' id='form1' name='form1' method='post' action='user_main.php' >
                            <input name='username' type='text' value='{$username}' />
                            <input name='password' type='text' value='{$password}'>
                       </form>
                        <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
            }
        }
        catch (user_exception $ex) {
            echo "<script language=javascript>alert('$ex');</script>";
        }
    }
    else if (!strcmp($signup, "注册")) {
        $url="signup.php";
        echo "<script language=javascript>location.href='$url'</script>";
    }
}

function test_input($data)
{
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
            密  码：<input type="password" name="password"/>
        </p>
        <input name="signup" type="submit" value="注册"/>
        <input name="login" type="submit" value="登录"/>
    </form>
</body>
</div>
</html>