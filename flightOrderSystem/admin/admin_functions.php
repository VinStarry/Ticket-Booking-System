<?php

include_once '../common/Flight.php';
include_once '../common/DBConnector.php';

class admin_exception_codes {
    public const UNKNOWN = 0;
    public const FIDNotNumeric = 1;
    public const PlaceNotValid = 2;
    public const SeatsNotNumeric = 3;
    public const FIDAlreadyExist = 4;
    public const InsertFlightFailed = 5;
    public const InvalidSeatsParam = 6;
    public const AddFlightDateFailed = 6;
    public const TimeLogicError = 7;
    public const DiscountNotNumeric = 8;
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
                return "Falied too many times, probably the server is busy, or some input error occurred.";
            case admin_exception_codes::InvalidSeatsParam:
                return "The parameter you set for seats is not in correct format";
            case admin_exception_codes::AddFlightDateFailed:
                return "Failed to add flight date,  probably the server is busy, or some input error occurred.";
            case admin_exception_codes::TimeLogicError:
                return "Begin time before begin service time or end time later than end service time";
            case admin_exception_codes::DiscountNotNumeric:
                return "Discount is not numeric";
            default:
                return "Some admin exception occurred.";
        }
    }
}

class admin_functions {

    private $airports;
    private $conn;
    private const RETRY_TIMES = 5;

    /**
     * admin_functions constructor.
     * Be careful that the constructor should create a DBConnector
     * and create airports codes' array
     */
    function __construct() {
        $this->conn = new DBConnector();
        $this->airports = $this->conn->get_all_airports_code();
    }

    /**
     * PAY ATTENTION to ERROR HANDLE and INPUT CHECK
     * @params basic information about flight
     *  this should always create seats for flight
     * @throws admin_exception
     */
    function add_flight($fid, $f_type, $depart_time,
                        $duration, $depart_place, $arrive_place,
                        $begin_service_date, $end_service_date,
                        $fnum, $enum, $cnum) {
        $new_flight = new Flight($fid, $f_type, $depart_time,
            $duration, $depart_place, $arrive_place,
            $begin_service_date, $end_service_date, $fnum, $enum, $cnum);

        /* input parameters tests */
        try {
            if (!is_numeric($fid)) {
                throw new admin_exception(admin_exception_codes::FIDNotNumeric);
            }
            else if (!in_array($depart_place, $this->airports) || !in_array($arrive_place, $this->airports)) {
                throw new admin_exception(admin_exception_codes::PlaceNotValid);
            }
            else if (!is_numeric($fnum) || !is_numeric($enum) || !is_numeric($cnum)) {
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
//                    echo $insert_flight_query. "<br />";
                    $this->conn->link->query($insert_flight_query, MYSQLI_STORE_RESULT);
                    $insert_flight_result = $this->conn->link->affected_rows;

                    if ($insert_flight_result > 0) {
                        $this->conn->link->commit();
                        $succeeded = true;
                        break;
                    }
                    else {
                        $this->conn->link->rollback();
                    }
                }while(--$retry_times);
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
            // Ensure that autocommit should be reopen
            $this->conn->link->autocommit(true);
        }
    }

    function delete_flight($fid) {
        // TODO: 2
    }

    /**
     * @param $fid              : corresponding to the flight
     * @param string $begin_date: day begin
     * @param string $end_date  : day end
     * @param int $interval_days: number of days between flights
     * @param int $edis         : economic seats' discount
     * @param int $cdis         : commercial seats' discount
     * @param int $fdis         : first-class seats' disconut
     * @throws admin_exception
     */
    function add_flying_date($fid, string $begin_date,
                             string $end_date, int $interval_days, int $edis, int $cdis, int $fdis,
                             string $E_seat_price, string $C_seat_price, string $F_seat_price) {
        try {
            $eprice = new decimal2P($E_seat_price);
            $cprice = new decimal2P($C_seat_price);
            $fprice = new decimal2P($F_seat_price);
            $search_fid = "select " . config\Flight_table::ID . "," . config\Flight_table::BEGIN_SERVICE
                .",". config\Flight_table::END_SERVICE .
                " from " . config\Flight_table::NAME .
                " where " . config\Flight_table::ID . " = " . $fid .";";

            $result = $this->conn->link->query($search_fid);
            list($rfid, $rbtime, $retime) = $result->fetch_row();
//            echo $search_fid . "<br />";
            if ($rfid == null) {
                throw new admin_exception(admin_exception_codes::FIDAlreadyExist);
            }
            else if(strtotime($begin_date) < strtotime($rbtime) || strtotime($end_date) > strtotime($retime)) {
                throw new admin_exception(admin_exception_codes::TimeLogicError);
            }
            else if(!is_numeric($edis) || !is_numeric($cdis) || !is_numeric($fdis)) {
                throw new admin_exception(admin_exception_codes::DiscountNotNumeric);
            }
            else if (($eprice->showMoney() == null) || ($cprice->showMoney() == null) || ($fprice->showMoney() == null)) {
                throw new admin_exception(admin_exception_codes::InvalidSeatsParam);
            }
            $retry_times =  self::RETRY_TIMES;
            $succeeded = false;
            do {
                $cnt = 0;
                for ($t = date($begin_date); $t <= date($end_date); ) {
                    $insert_flying_date = "insert into " . config\Flying_date_table::NAME . " values(" .
                        "'". date("Y-m-d", strtotime($t)). "'," . $fid .",". $edis .",". $cdis . "," . $fdis .
                        "," . $eprice . "," . $cprice . "," . $fprice . ",0,0,0,0.00);";
//                    echo $insert_flying_date . "<br />";
                    $this->conn->link->query($insert_flying_date, MYSQLI_STORE_RESULT);
                    $cnt += $this->conn->link->affected_rows;
                    $t = date("Y-m-d", strtotime("+$interval_days day", strtotime($t)));
                }
                if ($cnt > 0) {
                    $succeeded = true;
                    break;
                }
            }while($retry_times--);
            if ($retry_times == 0 && $succeeded == false) {
                throw new admin_exception(admin_exception_codes::InsertFlightFailed);
            }
        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (admin_exception $ex) {
            throw $ex;
        }
    }

    function delete_flying_date($fid, $cancel_date) {
        // TODO: 3
    }

    function list_data() {
        // TODO: 4
    }

    function show_revenue_by_day() {
        // TODO: 5
    }

    function show_revenue_by_month() {
        // TODO: 6
    }
}