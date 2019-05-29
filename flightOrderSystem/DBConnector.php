<?php

include_once 'config.php';

use config\DB_info as INFO;

class DBException extends Exception {
    function __construct($message = "", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class DBConnector {
    private $db_host;
    private $db_user;
    private $db_password;
    private $db_name;
    private $link;

    /*
     * construct connection to MySQL based on parameters
     * pay ATTENTION that these parameters (including the link itself) are PRIVATE variables
     */
    function __construct() {
        $this->db_host = INFO::SERVER_ADDRESS;
        $this->db_user = INFO::DATABASE_USER_NAME;
        $this->db_password = INFO::DATABASE_USER_PSW;
        $this->db_name = INFO::DATABASE_NAME;

        $this->link = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_name);

        try {
            if (!$this->link) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                throw new DBException("Connect to MySQL error", 0, null);
            }
        }
        catch (DBException $e) {
            echo "Error code ".$e->getCode().". ".$e->getMessage();
        }
    }

    function get_city_from_code(string $code) {
//        $query = "select "
    }

    /*
     * showTables is a function that tests the correctness of a query
     * it uses "show tables" in MySQL
    */
    final function showTables() {
        $test_query = "show tables";
        $result = $this->link->query($test_query);
        echo "Tables in ". $this->db_name. " are shown below: <br />";
        while(list($table_name) = $result->fetch_row())
            printf("%s <br />", $table_name);
    }

    /*
     * destructor simply close the connection between PHP and MySQL
     */
    function __destruct() {
        mysqli_close($this->link);
    }
}