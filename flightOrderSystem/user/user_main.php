<?php
include_once '../common/config.php';
include_once '../common/DBConnector.php';
include_once 'user_functions.php';

error_reporting(E_ALL & E_STRICT);

$conn = new DBConnector();
$user = User_functions::login_account($conn->link, 60001, 'tonybrown911');
echo "$user->UID : $user->UName : $user->UTelephone : $". $user->getUBalance() . "<br />"

?>