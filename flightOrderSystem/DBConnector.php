<?php


class DBConnector {
    private $db_host;
    private $db_user;
    private $db_password;
    private $db_name;
    private $link;

    function __construct(string $db_host, string $db_user, string $db_password, string $db_name) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_name = $db_name;

        $this->link = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (!$this->link) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
//        else {
//            echo "Successfully connected to MySQL Database.<br />";
//        }
    }

    function __destruct() {
        mysqli_close($this->link);
    }
}