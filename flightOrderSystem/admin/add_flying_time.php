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
            经济舱这周：<input type="number" name="edis"/>
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
        <p>
            <?php
//            $fid = $begin_date = $end_date = $interval_days = $edis = $cdis = $fdis =
//            $E_seat_price = $C_seat_price = $F_seat_price = "";
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