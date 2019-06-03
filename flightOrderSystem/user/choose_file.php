<?php   session_start();
    $option = $_POST['option'];
    $in_date = $_POST["in_date"];
    $src_city = $_POST['src_city'] ;
    $dst_city = $_POST['des_city'];
//    echo $option;
    if (!strcmp($option, '查票')) {
//        echo "$fid, $in_date, $src_city, $dst_city";
//        $_SESSION["fid"] = $fid;
//        $_SESSION["in_date"] = $in_date;
//        $_SESSION["src_city"] = $src_city;
//        $_SESSION["des_city"] = $dst_city;
//        $url="order_ticket.php";
        echo " <form style='display:none;' id='form1' name='form1' method='post' action='order_ticket.php' >
                            <input name='in_date' type='text' value='{$in_date}' />
                            <input name='src_city' type='text' value='{$src_city}' />
                            <input name='dst_city' type='text' value='{$dst_city}'>
                       </form>
                        <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
    }
    else if (!strcmp($option, "充值")) {
        $url="add_balance.php";
        echo "<script language=javascript>location.href='$url'</script>";
    }
    else if (!strcmp($option, '历史')) {
        $url="lookup_history.php";
        echo "<script language=javascript>location.href='$url'</script>";
    }
    else {
        echo  "hello1";
        $url="user_main.php";
        echo "<script language=javascript>location.href='$url'</script>";
    }


?>
