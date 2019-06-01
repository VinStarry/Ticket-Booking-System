<?php

include_once 'Flight.php';
include_once '../common/DBConnector.php';

class admin_exception_codes {
    public const UNKNOWN = 0;
    public const FIDNotNumeric = 1;
    public const PlaceNotValid = 2;
    public const SeatsNotNumeric = 3;
    public const FIDAlreadyExist = 4;
    public const InsertFlightFailed = 5;
}

class admin_exception extends Exception {
    public $code;

    function __construct($code = 0) {
        parent::__construct("", $code, null);
    }

    function __toString() {
        switch ($this->code) {
            case admin_exception_codes::UNKNOWN:
                return "Sorry, unknown exception";
            case admin_exception_codes::FIDNotNumeric:
                return "Format exception! FID is not numeric!";
            case admin_exception_codes::PlaceNotValid:
                return "Place is not valid!";
            case admin_exception_codes::SeatsNotNumeric:
                return "Seats not numeric!";
            case admin_exception_codes::FIDAlreadyExist:
                return "This FID already exists, please check carefully.";
            case admin_exception_codes::InsertFlightFailed:
                return "Falied too many times, probably the server is busy";
            default:
                return "Some admin exception occurred.";
        }
    }
}

class admin_functions {

    private $airports;
    private $conn;
    private const RETRY_TIMES = 5;

    function __construct() {
        $this->conn = new DBConnector();
        $this->airports = $this->conn->get_all_airports_code();
    }

    function add_flight($fid, $f_type, $depart_time,
                        $duration, $depart_place, $arrive_place,
                        $begin_service_date, $end_service_date, $seats_total) {
        $new_flight = new Flight($fid, $f_type, $depart_time,
            $duration, $depart_place, $arrive_place,
            $begin_service_date, $end_service_date, $seats_total);

        /* input parameters tests */
        try {
            if (!is_numeric($fid)) {
                throw new admin_exception(admin_exception_codes::FIDNotNumeric);
            }
            else if (!in_array($depart_place, $this->airports) || !in_array($arrive_place, $this->airports)) {
                throw new admin_exception(admin_exception_codes::PlaceNotValid);
            }
            else if (!is_numeric($seats_total)) {
                throw new admin_exception(admin_exception_codes::SeatsNotNumeric);
            }
            else {
                $search_fid = "select " . config\Flight_table::ID .
                    " from " . config\Flight_table::NAME .
                    " where " . config\Flight_table::ID . " = " . $fid;
                $result = $this->conn->link->query($search_fid);
                if ($result->fetch_row() != null) {
                    throw new admin_exception(admin_exception_codes::FIDAlreadyExist);
                }
                $retry_times =  self::RETRY_TIMES;
                $succeeded = false;

                do {
                    $this->conn->link->autocommit(false);
                    $insert_flight_query = "insert into " .config\Flight_table::NAME . " values(" .
                    $new_flight. ");";
                    $this->conn->link->query($insert_flight_query, MYSQLI_STORE_RESULT);
                    if ($this->conn->link->affected_rows != 0) {
                        $this->conn->link->commit();    // commit this transaction
                        $succeeded = true;
                        $this->conn->link->autocommit(true);
                        break;
                    }
                    else {
                        $this->conn->link->rollback();
                        $this->conn->link->autocommit(true);
                    }
                }while($retry_times--);
                if ($retry_times == 0 && $succeeded == false) {
                    throw new admin_exception(admin_exception_codes::InsertFlightFailed);
                }
            }
        }
        catch (mysqli_sql_exception $ex) {
            echo $ex . "<br />";
            throw $ex;
        }
        catch (admin_exception $ex) {
            throw $ex;
        }
        finally {
            $this->conn->link->autocommit(true);
        }
    }
}