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
$fid = $f_type = $depart_time = $duration = $depart_place = $arrive_place =
$begin_service_date = $end_service_date =
$fnum = $enum = $cnum = "";
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
            飞机类型：<input type="text" name="f_type"/>
        </p>
        <p>
            出发时间：<input type="time" name="depart_time"/>
        </p>
        <p>
            飞行时长：<input type="number" name="duration"/>
        </p>
        <p>
            出发城市：<select name="depart_place">
                <?php
                foreach ($admin->airports as $code) {
                    echo "<option value = $code>$code</option>";
                }
                ?>
            </select>
        </p>
        <p>
            目的城市：<select name="arrive_place">
                <?php
                foreach ($admin->airports as $code) {
                    echo "<option value = $code>$code</option>";
                }
                ?>
            </select>
        </p>
        <p>
            开始服务时间：<input type="date" name="begin_service_date"/>
        </p>
        <p>
            结束服务时间：<input type="date" name="end_service_date"/>
        </p>
        <p>
            头等舱数量：<input type="number" name="fnum"/>
        </p>
        <p>
            商务舱数量：<input type="number" name="cnum"/>
        </p>
        <p>
            经济舱数量：<input type="number" name="enum"/>
        </p>
        <input name="order_button" type="submit" value="添加"/>
        <div class="demo">
            <a href="home.php" class="button blue bigrounded" >返回</a>
        </div>
        <p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fid = test_input($_POST["fid"]);
                $f_type = test_input($_POST["f_type"]);
                $depart_time = test_input($_POST["depart_time"]);
                $duration = test_input($_POST["duration"]);
                $depart_place = test_input($_POST["depart_place"]);
                $arrive_place = test_input($_POST["arrive_place"]);
                $begin_service_date = test_input($_POST["begin_service_date"]);
                $end_service_date = test_input($_POST["end_service_date"]);
                $fnum = test_input($_POST["fnum"]);
                $enum = test_input($_POST["enum"]);
                $cnum = test_input($_POST["cnum"]);
                $order_button = test_input($_POST["order_button"]);

                if (!strcmp($order_button, "添加")) {
                    try {
                        $admin = new admin_functions();
                        $admin->add_flight($fid, $f_type, $depart_time,
                            $duration, $depart_place, $arrive_place,
                            $begin_service_date, $end_service_date,
                            $fnum, $enum, $cnum);
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