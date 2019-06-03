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
include_once 'admin_functions.php';
$username = $password = $tel = $signupok = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fid = test_input($_POST["fid"]);
    $fdate = test_input($_POST["fdate"]);
    $signupok = test_input($_POST["signupok"]);
    $conn = new DBConnector(false);
    if (!strcmp($signupok, "OK")) {
        try {
            $conn = new DBConnector();
            $query = "select f_FID from flying_date where f_FID = $fid and f_date = '$fdate';";
            $serializable = "set session transaction isolation level serializable;";
            $conn->link->query($serializable);
            $conn->link->autocommit(false);
            $result = $conn->link->query($query);

            if (list($tempfid) = $result->fetch_row()) {
                $query = "select T_CANCELED, T_OID, T_PRICE from ticket_t where T_FID = $fid and date(T_TOKEOFFTIME) = '$fdate';";
                $result = $conn->link->query($query);
                while (list($tcanceled, $toid, $tprice) = $result->fetch_row()) {
                    if ((bool)$tcanceled == false) {
                        $tempq = "select O_PAID, O_UID from Order_t where O_ID = $toid";
                        if (list($opaid, $ouid) = $tempq) {
                            $refund = $conn->link->query("update User_t set U_BALANCE = U_BALANCE + $tprice where U_ID = $ouid;", MYSQLI_STORE_RESULT);
                            if ($conn->link->affected_rows != 1) {
                                throw new admin_exception(admin_exception_codes::UNKNOWN);
                            }
                        }
                    }
                }

                $delete_query = "delete from Flying_date where f_FID = $fid and f_date = '$fdate';";
                $conn->link->query($delete_query);
                $conn->link->commit();
                echo "<script language=javascript>alert('删除成功!');</script>";
            }
            else {
                throw new admin_exception(admin_exception_codes::NoSuchFlight);
            }
        }
        catch (admin_exception $ex) {
            echo "<script language=javascript>alert('$ex');</script>";
        }
        catch (mysqli_sql_exception $ex) {
            echo "<script language=javascript>alert('$ex');</script>";
        }
        finally {
            $conn->link->autocommit(true);
            $serializable = "set session transaction isolation repeatable read;";
            $conn->link->query($serializable);
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
            飞行计划取消模块
        </p>
        <p>
            飞机编号：<input type="number" name="fid"/>
        </p>
        <p>
            飞行日期：<input type="date" name="fdate"/>
        </p>
        <input name="signupok" type="submit" value="OK"/>
        <p>
            <div class="demo">
            <a href="home.php" class="button blue bigrounded" >返回</a>
        </div>
        </p>
    </form>
</body>
</div>
</html>