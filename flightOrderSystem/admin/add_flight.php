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