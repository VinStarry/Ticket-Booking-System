<?php

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

    function __construct(string $db_host, string $db_user, string $db_password, string $db_name) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_name = $db_name;

        $this->link = mysqli_connect($db_host, $db_user, $db_password, $db_name);

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

    function __destruct() {
        mysqli_close($this->link);
    }
}