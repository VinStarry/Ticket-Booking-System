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
    public $link;

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

    /**
     * display whole table
     * @param string $table_name: the table name
     * @return array whole table stored in array
     */
    function get_full_table(string $table_name) {
        try {
            $query = "select * " .
                " from " . $table_name . ";";
            $result = $this->link->query($query);
            $number_column = $result->field_count;
            $ret = array();

            // fetch columns and rows
            while ($row = $result->fetch_row()) {
                $temp = array();
                for ($i = 0; $i < $number_column; $i++) {
                    $temp[] = $row[$i];
                }
                $ret[] = $temp;
            }

            $result->free();
            return $ret;
        }
        catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
            throw $ex;
        }
    }

    /**
     * get all airports' code
     * @return array the array contains all airports' code in the database
     */
    function get_all_airports_code() {
        try {
            $query = "select " . config\Code_CITY::CODE .
                " from " . config\Code_CITY::NAME .";";
            $result = $this->link->query($query);
            $ret = array();
            while(list($code) = $result->fetch_row()) {
                $ret[] = $code;
            }
            $result->free();
            return $ret;
        }
        catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
            throw $ex;
        }
    }

    /**
     * @param string $code: the code corresponding to the airport
     * @example: input --> PVG
     *          output --> 上海
     */
    function get_city_from_code(string $code) {
        try {
            $query = "select " . config\Code_CITY::CITY .
                " from " . config\Code_CITY::NAME .
                " where " . config\Code_CITY::CODE . " = \"" . $code . "\";";
                    $result = $this->link->query($query);
            if(list($city) = $result->fetch_row()) {
                $result->free();
                return $city;
            }
            else {
                $result->free();
                return null;
            }
        }
        catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
            throw $ex;
        }
    }

    /**
     * @param string $city: a city's name
     * @example: input --> 上海
     *          output --> [PVG, SHA]
     */
    function get_code_from_city(string $city) {
        try {
            $query = "select " . config\Code_CITY::CODE .
                " from " . config\Code_CITY::NAME .
                " where " . config\Code_CITY::CITY . " = \"" . $city . "\";";
            $result = $this->link->query($query);
            $codes = array();
            while(list($code) = $result->fetch_row()) {
                $codes[] = $code;
            }
            $result->free();
            return $codes;
        }
        catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
            throw $ex;
        }
    }

    /**
     * @param string $city: a city's name
     * @return array 2D array
     * @example: input --> 上海
     *           output --> [[PVG, 上海浦东国际机场] , [SHA, 上海虹桥国际机场]]
     */
    function get_airport_and_code_from_city(string $city) {
        try {
            $query = "select " . config\Code_CITY::CODE . ", " . config\Code_CITY::AP_NAME .
                " from " . config\Code_CITY::NAME .
                " where " . config\Code_CITY::CITY . " = \"" . $city . "\";";
            $result = $this->link->query($query);
            $ret = array();
            while(list($code, $airport) = $result->fetch_row()) {
                $row = array();
                $row[] = $code;
                $row[] = $airport;
                $ret[] = $row;
            }
            $result->free();
            return $ret;
        }
        catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
            throw $ex;
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
        $result->free();
    }

    /**
     * print the whole table, used for debugging
     * @param array $arr the table
     */
    final function printWholeTable(array $arr) {
        for ($i = 0; $i < count($arr); $i++) {
            $row = $arr[$i];
            for ($j = 0; $j < count($row); $j++) {
                echo $row[$j] . " ";
            }
            echo "<br />";
        }
    }

    /*
     * destructor simply close the connection between PHP and MySQL
     */
    function __destruct() {
        mysqli_close($this->link);
    }
}