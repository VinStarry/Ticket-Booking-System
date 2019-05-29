<?php
include_once 'config.php';
include_once 'DBConnector.php';

use config\DB_info as INFO;

error_reporting(E_ALL & E_STRICT);

$conn = new DBConnector(INFO::SERVER_ADDRESS,
                            INFO::DATABASE_USER_NAME,
                        INFO::DATABASE_USER_PSW,
                            INFO::DATABASE_NAME);

$conn->showTables();

?>