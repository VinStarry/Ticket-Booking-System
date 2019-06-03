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
<style type="text/css">
    .divForm{
        position: absolute;/*绝对定位*/
        width: 300px;
        height: 200px;

        text-align: center;/*(让div中的内容居中)*/
        top: 50%;
        left: 50%;
        margin-top: -400px;
        margin-left: -150px;
    }
</style>
<html>
<body>

<?php
include '../common/config.php';
include '../common/DBConnector.php';
include 'admin_functions.php';
//$fid, string $begin_date,
//                             string $end_date, int $interval_days, int $edis, int $cdis, int $fdis,
//                             string $E_seat_price, string $C_seat_price, string $F_seat_price
$fid = $begin_date = $end_date = $interval_days = $edis = $cdis = $fdis =
$E_seat_price = $C_seat_price = $F_seat_price = "";
$admin = new admin_functions();

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
            欢迎进入添加飞机模块
        </p>
        <p>
            飞机编号：<input type="text" name="fid"/>
        </p>
        <p>
            开始飞行日期：<input type="date" name="begin_date"/>
        </p>
        <p>
            结束飞行日期：<input type="date" name="end_date"/>
        </p>
        <p>
            间隔天数：<input type="number" name="interval_days"/>
        </p>
        <p>
            经济舱折扣：<input type="number" name="edis"/>
        </p>
        <p>
            商务舱折扣：<input type="number" name="cdis"/>
        </p>
        <p>
            头等舱折扣：<input type="number" name="fdis"/>
        </p>
        <p>
            经济舱金额：<input type="number" name="E_seat_price"/>
        </p>
        <p>
            商务舱金额：<input type="number" name="C_seat_price"/>
        </p>
        <p>
            头等舱金额：<input type="number" name="F_seat_price"/>
        </p>
        <input name="order_button" type="submit" value="添加"/>
        <div class="demo">
            <a href="home.php" class="button blue bigrounded" >返回</a>
        </div>
        <p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fid = test_input($_POST["fid"]);
                $begin_date = test_input($_POST["begin_date"]);
                $end_date = test_input($_POST["end_date"]);
                $interval_days = test_input($_POST["interval_days"]);
                $edis = test_input($_POST["edis"]);
                $cdis = test_input($_POST["cdis"]);
                $fdis = test_input($_POST["fdis"]);
                $E_seat_price = test_input($_POST["E_seat_price"]).".00";
                $C_seat_price = test_input($_POST["C_seat_price"]).".00";
                $F_seat_price = test_input($_POST["F_seat_price"]).".00";
                $order_button = test_input($_POST["order_button"]);

                if (!strcmp($order_button, "添加")) {
                    try {
                        $admin = new admin_functions();
//                        echo "$fid, $begin_date,
//                            $end_date, $interval_days, $edis, $cdis, $fdis,
//                             $E_seat_price, $C_seat_price, $F_seat_price";
                        $admin->add_flying_date($fid, $begin_date,
                            $end_date, $interval_days, $edis, $cdis, $fdis,
                             $E_seat_price, $C_seat_price, $F_seat_price);
                        echo "<script language=javascript>alert('添加成功');</script>";
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