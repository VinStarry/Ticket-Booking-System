<?php

use config\Flying_date_table;
use config\Order_table;
use config\Ticket_table;
use config\User_table;

include_once '../common/decimal2P.php';

/**
 * Class user_exception_codes shows the exception codes for user_exception
 */
class user_exception_codes {
    public const InvalidInput = 0;
    public const NameTooLong = 1;
    public const PswTooLong = 2;
    public const TelTooLong = 3;
    public const InsertAcconutFailed = 4;
    public const AccountNotExist = 5;
    public const IDInvalidFormat = 6;
    public const SrcPlaceNotExist = 7;
    public const DstPlaceNotExist = 8;
    public const NoTargetFlight = 9;
    public const ServerBusy = 10;
    public const TooLatetoDo = 11;
    public const AlreadyCanceled = 12;
    public const AlreadyPaid = 13;
    public const AlreadyGot = 14;
    public const NotEnoughBalance = 15;
    public const CouldNotFindOrder = 16;
    public const HaventPaid = 17;
    public const TooEarly = 18;
}

class user_exception extends Exception {
    public $code;

    public function __construct($code = 0) {
        $this->code = $code;
        parent::__construct("", $code, null);
    }

    public function __toString() {
        switch ($this->code) {
            case user_exception_codes::InvalidInput:
                return "Invalid input";
            case user_exception_codes::NameTooLong:
                return "Name too long.";
            case user_exception_codes::PswTooLong:
                return "Password too long.";
            case user_exception_codes::TelTooLong:
                return "Telephone too long.";
            case user_exception_codes::InsertAcconutFailed:
                return "Insert into user account table falied, This mainly happens when the Server is busy";
            case user_exception_codes::AccountNotExist:
                return "Sorry, this Account do not exist";
            case user_exception_codes::IDInvalidFormat:
                return "Invalid Format! ID can only be numbers";
            case user_exception_codes::SrcPlaceNotExist:
                return "There are no flight coming from the city you search";
            case user_exception_codes::DstPlaceNotExist:
                return "There are no flight coming to the city you search";
            case user_exception_codes::NoTargetFlight:
                return "No flight satisfy all the conditions";
            case user_exception_codes::ServerBusy:
                return "Operation failed, probably the server is busy, please contact the admin";
            case user_exception_codes::TooLatetoDo:
                return "It it too late";
            case user_exception_codes::AlreadyCanceled:
                return "It is already canceled";
            case user_exception_codes::AlreadyPaid:
                return "It is already paid";
            case user_exception_codes::AlreadyGot:
                return "The ticket is already got";
            case user_exception_codes::NotEnoughBalance:
                return "Sorry, you don't enough balance to pay for the order";
            case user_exception_codes::CouldNotFindOrder:
                return "Sorry, could not find the order";
            case user_exception_codes::HaventPaid:
                return "Sorry, you haven't paid for the ticket";
            case user_exception_codes::TooEarly:
                return "To early to do this";
            default:
                return "Some user exception occurred.";
        }
    }
}

class flight_User {
    /**
     * User basic info
     */
    public $UID;
    public $UName;
    public $UTelephone;
    private $UBalance;

    /**
     * flight_User constructor. Construct basic info
     * @param int $uid      User's ID
     * @param string $uname User's Name
     * @param string $utel  User's telephone number (string)
     * @param string $ubalance User's balance, defalut $5000.00
     */
    public function __construct(int $uid, string $uname, string $utel, string $ubalance) {
        $this->UID = $uid;
        $this->UName = $uname;
        $this->UTelephone = $utel;
        $this->UBalance = $ubalance;
    }

    /**
     * @return string return balance
     */
    final public function getUBalance(): string {
        return $this->UBalance;
    }

    /**
     * @param string $money
     * @example input 500, Ubalance = 5000
     *          after this function Ubalance = 5500
     */
    final public function incBalance(string $money): void {
        $nowbalance = new decimal2P($this->UBalance);
        $bm = new decimal2P($money);
        $nowbalance->plus($bm);
        $this->UBalance = $nowbalance->showMoney();
    }

    /**
     * @param string $money
     * @example input 500, Ubalance = 5000
     *          after this function Ubalance = 4500
     */
    final public function decBalance(string $money): void {
        $nowbalance = new decimal2P($this->UBalance);
        $bm = new decimal2P($money);
        $nowbalance->minus($bm);
        $this->UBalance = $nowbalance->showMoney();
    }

    /**
     * @param string $UBalance
     * Ubalance can only be revised through a class which inherit
     * class flight_User
     */
    final protected function setUBalance(string $UBalance): void {
        $this->UBalance = $UBalance;
    }

}

final class User_functions {
    /**
     * Constants
     */
    const RETRY_TIMES = 3;

    /**
     * create an account for user, and insert it into User_table
     * @param mysqli $link:  mysqli connection
     * @param string $name:  user input name
     * @param string $psw:  user input password
     * @param string $tel:  user input telephone
     * @throws user_exception   some exception specified by Code
     */
    public static function create_account(mysqli &$link, string $name, string $psw, string $tel) {
        if (strlen($name) >= 30) {
            throw new user_exception(user_exception_codes::NameTooLong);
        }
        else if (strlen($psw) >= 30) {
            throw new user_exception(user_exception_codes::PswTooLong);
        }
        else if (strlen($tel) >= 20) {
            throw new user_exception(user_exception_codes::TelTooLong);
        }
        else {
            try {
                $retry_times = self::RETRY_TIMES;
                $succeeded = false;
                do {
                    $link->autocommit(false);
                    $find_max_id_query = "select max(" . config\User_table::ID . ")" .
                        " from " . config\User_table::NAME;
                    $result = $link->query($find_max_id_query);
                    list($maxid) = $result->fetch_row();
                    $id = ($maxid == null) ? 60001 : $maxid + 1;
                    $insert_account = "insert into " . config\User_table::NAME .
                        " values(" . "$id,'$psw','$name','$tel'" . ");";
                    $link->query($insert_account, MYSQLI_STORE_RESULT);
                    if ($link->affected_rows != 0) {
                        $link->commit();    // commit this transaction
                        $succeeded = true;
                        $link->autocommit(true);
                        break;
                    }
                    else {
                        $link->rollback();
                        $link->autocommit(true);
                    }
                    $retry_times--;
                }while($retry_times != 0);
                if ($succeeded == false) {
                    // Already tried TRY_TIMES times but still failed, this is mainly because
                    // the server is busy at the time being
                    throw new user_exception(user_exception_codes::InsertAcconutFailed);
                }
            }
            catch (mysqli_sql_exception $ex) {
                echo $ex->getMessage();
                throw $ex;
            }
            catch (user_exception $ex) {
                throw $ex;
            }
            finally {
                // whatever happened, set mode to autocommit
                $link->autocommit(true);
            }
        }
    }

    /**
     * this function is for user login
     * @param mysqli $link          mysqli connection
     * @param string $uid           user input id
     * @param string $upsw          user input password
     * @return flight_User|null     return a new user class object, return null if psw is not correct
     * @throws user_exception   some exception specified by Code
     */
    public static function login_account(mysqli &$link, string $uid, string $upsw) {
        try {
            if (!is_numeric($uid)) {
                throw new user_exception(user_exception_codes::IDInvalidFormat);
            }
            $query = "select " .config\User_table::PASSWORD . "," . config\User_table::UNAME . ","
                . config\User_table::TELEPHONE . "," .config\User_table::BALANCE .
                " from " . config\User_table::NAME .
                " where " . config\User_table::ID . " = " . $uid . ";";
            $result = $link->query($query);
            list($expect_psw, $uname, $utelephone, $ubalance) = $result->fetch_row();
            $result->free();
            if ($expect_psw == null) {
                throw new user_exception(user_exception_codes::AccountNotExist);
            }
            else {
                if (!strcmp($expect_psw, $upsw)) {
                    return new flight_User($uid, $uname, $utelephone, $ubalance);
                }
                else {
                    return null;
                }
            }
        }
        catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
    }

    /**
     * this function is for user to search Tickets
     * @param string $target_date
     * @param string $from_place
     * @param string $to_place
     * @throws user_exception
     */
    public static function search_tickets(string $target_date,
                                   string $from_place, string $to_place) {
        try {
            $conn = new DBConnector(false);
            $src_arr = $conn->get_airport_and_code_from_city($from_place);
            $dst_arr = $conn->get_airport_and_code_from_city($to_place);

            if (count($src_arr) == 0) {
                throw new user_exception(user_exception_codes::SrcPlaceNotExist);
            }
            else if(count($dst_arr) == 0) {
                throw new user_exception(user_exception_codes::DstPlaceNotExist);
            }
            else if ($target_date == null) {
                throw new user_exception(user_exception_codes::InvalidInput);
            }
            else if (strtotime(config\BJ_time::get_current_date()) > strtotime($target_date)) {
                throw new user_exception(user_exception_codes::TooLatetoDo);
            }

            $ret = array();
            for ($i = 0; $i < count($src_arr); $i++) {
                for ($j = 0; $j < count($dst_arr); $j++) {
                    $flight_query = "select " . config\Flight_table::ID . "," . config\Flight_table::TYPE . "," .
                                config\Flight_table::DEPART_TIME . "," . config\Flight_table::DURATION . "," .
                                config\Flight_table::FSEAT_NUMBER . "," . config\Flight_table::CSEAT_NUMBER . "," .
                                config\Flight_table::ESEAT_NUMBER .
                        " from " . config\Flight_table::NAME .
                        " where " .config\Flight_table::DEPART_PLACE . "=" . "'" . $src_arr[$i][0] . "'" .
                                " and " . config\Flight_table::ARRIVE_PLACE . "=" . "'" . $dst_arr[$j][0] . "';";

                    $result = $conn->link->query($flight_query);

                    while (list($fid, $ftype, $fdptime, $fduration, $ffn, $fcn, $fen) = $result->fetch_row()) {
                        $spec_query = "select " . config\Flying_date_table::EDISCOUNT . "," .
                            config\Flying_date_table::CDISCOUNT . "," . config\Flying_date_table::FDISCOUNT . ",".
                            config\Flying_date_table::EPRICE . "," . config\Flying_date_table::CPRICE . "," .
                            config\Flying_date_table::FPRICE . "," . config\Flying_date_table::ETAKEN . "," .
                            config\Flying_date_table::CTAKEN . "," . config\Flying_date_table::FTAKEN .
                            " from " .config\Flying_date_table::NAME .
                            " where " .config\Flying_date_table::FID . "=" . $fid .
                                    " and " . config\Flying_date_table::FDATE . "=" . "'" . $target_date . "';";

                        $tar = $conn->link->query($spec_query);
                        if (list($edis, $cdis, $fdis, $ep, $cp, $fp, $et, $ct, $ft) = $tar->fetch_row()) {
                            $e_final_price = new decimal2P((string)$ep);
                            $e_final_price->multiply_discount($edis);
                            $c_final_price = new decimal2P($cp);
                            $c_final_price->multiply_discount($cdis);
                            $f_final_price = new decimal2P($fp);
                            $f_final_price->multiply_discount($fdis);
                            $eleft = (int)$et < (int)$fen ? "Y" : "N";
                            $cleft = (int)$ct < (int)$fcn ? "Y" : "N";
                            $fleft = (int)$ft < (int)$ffn ? "Y" : "N";
                            $fartime = date("H:i:s",strtotime("+$fduration min",strtotime($fdptime)));
                            $src_airport = $src_arr[$i][1];
                            $dst_airport = $dst_arr[$j][1];
                            $temp = array($fid, $ftype, $src_airport, $dst_airport, $target_date, $fdptime, $fartime,
                                $e_final_price, $c_final_price, $f_final_price, $eleft, $cleft, $fleft);
                            $ret[] = $temp;
                            $tar->free();
                        }
                    }

                    $result->free();
                }
            }
            if (count($ret) == 0) {
                throw new user_exception(user_exception_codes::NoTargetFlight);
            }
        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * order a ticket for the specific user
     * @param mysqli $link
     * @param flight_User $usr
     * @param string $prc   : price of all tickets (in this one order)
     * @param $fid
     * @param $seat_class
     * @param string $offtime   : tookoff time of the flight
     * @throws user_exception
     */
    public static function order_tickets(mysqli &$link, flight_User &$usr,
                                         string $prc, $fid, $seat_class, string $offtime) {
        try {
            $try_times = self::RETRY_TIMES;
            $succeeded = false;
            $final_price = new decimal2P($prc);

            do {
                $link->autocommit(false);
                $oid_query = "select max(" . config\Order_table::ID . ")" .
                    " from " . config\Order_table::NAME . ";";

                $oid_result = $link->query($oid_query);
                $cur_time = config\BJ_time::get_current_datetime();

                // if you order the ticket within 3 hours before the flight, you are not allowed
                // to order this ticket
                if (strtotime(config\BJ_time::get_limited_datetime()) > strtotime($offtime)) {
                    throw new user_exception(user_exception_codes::TooLatetoDo);
                }

                list($oid) = $oid_result->fetch_row();
                $oid = ($oid == null) ? 90001 : $oid + 1;
                $insert_order = "insert into " . config\Order_table::NAME . " values(" .
                                "$oid, $usr->UID, '$cur_time', false, '$final_price');";

                $link->query($insert_order, MYSQLI_STORE_RESULT);
                if ($link->affected_rows > 0) {
                    $tid_query = "select max(" . config\Ticket_table::ID . ")" .
                        " from " . config\Ticket_table::NAME . ";";

                    $tid_result = $link->query($tid_query);

                    list($tid) = $tid_result->fetch_row();
                    $tid = ($tid == null) ? 120001 : $tid + 1;
                    $insert_ticket = "insert into " . config\Ticket_table::NAME . " values(" .
                        "$tid, $oid, false, null, '$offtime', $fid, '$seat_class', '$final_price');";

                    $link->query($insert_ticket, MYSQLI_STORE_RESULT);
                    if ($link->affected_rows > 0) {
                        $update_seats = "";
                        $off_date = date("Y-m-d",strtotime($offtime));
                        if ($seat_class == 'E') {
//                            $update_seats = "update Flying_date set e_taken = e_taken + 1 where f_date = '2019-08-31' and f_FID = 351;"
                            $update_seats = "update ".config\Flying_date_table::NAME." set ".config\Flying_date_table::ETAKEN." = ".config\Flying_date_table::ETAKEN." + 1".
                                " where f_date = '$off_date' and f_FID = '$fid';";
                        }
                        else if ($seat_class == 'C') {
                            $update_seats = "update ".config\Flying_date_table::NAME." set ".config\Flying_date_table::CTAKEN." = ".config\Flying_date_table::CTAKEN." + 1".
                                " where f_date = '$off_date' and f_FID = '$fid';";
                        }
                        else {
                            $update_seats = "update ".config\Flying_date_table::NAME." set ".config\Flying_date_table::FTAKEN." = ".config\Flying_date_table::FTAKEN." + 1".
                                " where f_date = '$off_date' and f_FID = '$fid';";
                        }
//                        echo $update_seats. "<br />";
                        $link->query($update_seats, MYSQLI_STORE_RESULT);
                        if($link->affected_rows > 0) {
                            $succeeded = true;
                            $link->commit();
                            break;
                        }
                        else {
                            $link->rollback();
                        }
                    }
                    else {
                        $link->rollback();
                    }
                }
                else {
                    $link->rollback();
                }
            } while($try_times--);

            if ($try_times == 0 && $succeeded == false) {
                throw new user_exception(user_exception_codes::ServerBusy);
            }
        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw $ex;
        }
        finally {
            $link->autocommit(true);
        }
    }

    /**
     * buy a ticket for the specific user
     * @param mysqli $link
     * @param flight_User $usr
     * @param $oid
     * @throws user_exception
     */
    public static function pay_for_orders(mysqli &$link, flight_User &$usr, $oid) {
        try {
            $select_order = "select ".config\Ticket_table::CANCELED . "," .
                config\Ticket_table::TOOKOFF_TIME .
                " from " . config\Ticket_table::NAME .
                " where " . config\Ticket_table::OID . "=" . $oid . ";";
            $result_rows = $link->query($select_order);

            $satisfied = true;
            while (list($canceled, $offtime) = $result_rows->fetch_row()) {
                if ((bool)$canceled == true) {
                    throw new user_exception(user_exception_codes::AlreadyCanceled);
                }
                else if (strtotime(config\BJ_time::get_current_datetime()) > strtotime($offtime)) {
                    $satisfied = false;
                }
            }

            $result_rows->free();

            if (!$satisfied) {
                throw new user_exception(user_exception_codes::TooLatetoDo);
            }
            else {
                $select_order = "select " .config\Order_table::PAID . "," .
                    config\Order_table::COST . " from " . config\Order_table::NAME .
                    " where " . config\Order_table::ID . " = " . $oid . ";";

                $result_rows = $link->query($select_order);

                if (list($paid, $cost) = $result_rows->fetch_row()) {
                    if ((bool)$paid == true) {
                        throw new user_exception(user_exception_codes::AlreadyPaid);
                    }
                    $cost2p = new decimal2P($cost);
                    $ublance = new decimal2P($usr->getUBalance());
                    if($ublance->compare($cost2p) == false) {
                        throw new user_exception(user_exception_codes::NotEnoughBalance);
                    }
                    else {
                        $link->autocommit(false);
                        $update_query = "update " . config\Order_table::NAME .
                            " set " . config\Order_table::PAID . " = true" .
                            " where " . config\Order_table::ID . " = " . $oid . ";";
                        $link->query($update_query, MYSQLI_STORE_RESULT);
                        if ($link->affected_rows > 0) {
                            $usr->decBalance($cost);
                            $update_query = "update " . config\User_table::NAME .
                                " set " . config\User_table::BALANCE . " = " .$usr->getUBalance() .
                                " where " . config\User_table::ID . " = " . $usr->UID . ";";
                            $link->query($update_query, MYSQLI_STORE_RESULT);
                            if ($link->affected_rows > 0) {
                                $link->commit();
                            }
                            else {
                                $usr->incBalance($cost);
                                $link->rollback();
                                throw new user_exception(user_exception_codes::ServerBusy);
                            }
                        }
                        else {
                            $link->rollback();
                            throw new user_exception(user_exception_codes::ServerBusy);
                        }
                    }
                }
                else {
                    throw new user_exception(user_exception_codes::CouldNotFindOrder);
                }
            }

        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw $ex;
        }
        finally {
            $link->autocommit(true);
        }
    }

    /**
     * add balance to account
     * @param mysqli $link
     * @param flight_User $usr
     * @param string $money     the money add to the account
     * @throws user_exception
     * Generate a new decimal2P object for money
     */
    public static function add_balance(mysqli &$link, flight_User &$usr, string $money) {
        // in UI, it needs user to choose, 100.00, 500.00, 1000.00, 5000.00
        try {
            $link->autocommit(false);
            $add_money = new decimal2P($money);
            $query = "update ". config\User_table::NAME .
                     " set " . config\User_table::BALANCE ."=" .  config\User_table::BALANCE ."+" .$add_money.
                     " where " . config\User_table::ID. "=". $usr->UID  .";";

            $try_times = self::RETRY_TIMES;
            $succeed = false;

            do {
                $link->query($query, MYSQLI_STORE_RESULT);
                if ($link->affected_rows > 0) {
                    $succeed = true;
                    $link->commit();
                    break;
                }
                else {
                    $link->rollback();
                }
            }while($try_times--);

            if ($try_times == 0 && $succeed == false) {
                throw new user_exception(user_exception_codes::ServerBusy);
            }
            else {
                $usr->incBalance($money);
            }
        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw $ex;
        }
        finally {
            $link->autocommit(true);
        }
    }

    /**
     * Take ticket based on a specific tid
     * @param mysqli $link
     * @param flight_User $usr
     * @param $tid
     * @throws user_exception
     */
    public static function take_ticket(mysqli &$link, flight_User &$usr, $tid) {
        try {
            $try_times = self::RETRY_TIMES;
            $succeeded = false;
            do {
                $tic_search = "select " .
                    config\Ticket_table::OID . "," . config\Ticket_table::CANCELED . "," .
                    config\Ticket_table::GOT_TIME . "," . config\Ticket_table::TOOKOFF_TIME .
                    " from " . config\Ticket_table::NAME . " where " . config\Ticket_table::ID . " = " . $tid . ";";

                $tic_result = $link->query($tic_search);

                while (list($oid, $canceled, $gott, $offt) = $tic_result->fetch_row()) {
//                    echo "$oid, $canceled, $gott, $offt <br />";
                    if ((bool)$canceled == true) {
                        throw new user_exception(user_exception_codes::AlreadyCanceled);
                    }
                    else if ($gott != null) {
                        throw new user_exception(user_exception_codes::AlreadyGot);
                    }
                    else {
                        $cur_t_plus_24h = strtotime("+24 hour", strtotime(config\BJ_time::get_current_datetime()));
                        if (strtotime($offt) > $cur_t_plus_24h) {
                            throw new user_exception(user_exception_codes::TooEarly);
                        }
                        else {
                            $order_search = "select ".config\Order_table::PAID.
                                " from ".config\Order_table::NAME." where ".config\Order_table::ID." = ".$oid.";";
//                            echo "$order_search <br />";
                            $result = $link->query($order_search);

                            list($paid) = $result->fetch_row();
                            if ($paid != null && (bool)$paid == true) {
                                // update ticket table
                                $link->autocommit(false);
                                $ctime = config\BJ_time::get_current_datetime();
                                $update_query = "update ".config\Ticket_table::NAME.
                                    " set ".config\Ticket_table::GOT_TIME." = '$ctime' where ".
                                    config\Ticket_table::ID." = ".$tid.";";

                                $link->query($update_query, MYSQLI_STORE_RESULT);

                                if ($link->affected_rows == 1) {
                                    $link->commit();
                                    $link->autocommit(true);
                                    return;
                                }
                                else {
                                    $link->rollback();
                                }
                            }
                            else {
                                throw new user_exception(user_exception_codes::HaventPaid);
                            }
                        }
                    }
                }

            }while($try_times--);
            if ($try_times == 0 && !$succeeded) {
                $link->rollback();
                throw new user_exception(user_exception_codes::ServerBusy);
            }
        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw $ex;
        }
        finally {
            $link->autocommit(true);
        }
    }

    public static function cancel_ticket(mysqli &$link, flight_User &$usr, $tid) {
        // TODO: 7 UPDATE Flying_date TABLE!
        try {
            $try_times = self::RETRY_TIMES;
            $succeeded = false;

            do {
                $tic_search = "select ".config\Ticket_table::OID.",".config\Ticket_table::CANCELED.",".config\Ticket_table::GOT_TIME.","
                    .config\Ticket_table::TOOKOFF_TIME.",".config\Ticket_table::FID.",".config\Ticket_table::SEATCLAS.",".config\Ticket_table::PRICE.
                    " from ".config\Ticket_table::NAME." where ".config\Ticket_table::ID." = $tid;";
                $tic_result = $link->query($tic_search);

                if (list($oid, $canceled, $gtime, $offtime, $fid, $seat_class, $price) = $tic_result->fetch_row()) {
//                    echo "$oid, $canceled, $gtime, $offtime, $fid, $seat_class, $price <br />";
                    $curtime = config\BJ_time::get_current_datetime();
                    if ($gtime != null) {
                        throw new user_exception(user_exception_codes::AlreadyGot);
                    }
                    else if(strtotime($curtime) > strtotime($offtime)) {
                        throw new user_exception(user_exception_codes::TooLatetoDo);
                    }
                    else if ((bool)$canceled == true) {
                        throw new user_exception(user_exception_codes::AlreadyCanceled);
                    }
                    else {
                        $query_paid = "select ".config\Order_table::PAID." from ".
                            config\Order_table::NAME." where ".config\Order_table::ID." = $oid;";
                        $paid_result = $link->query($query_paid);

                        if (list($alpaid) = $paid_result->fetch_row()) {
                            $link->autocommit(false);
                            $off_date = date("Y-m-d",strtotime( $offtime));
                            $update_seats = "";
                            if ($seat_class == 'E') {
//                            $update_seats = "update Flying_date set e_taken = e_taken - 1 where f_date = '2019-08-31' and f_FID = 351;"
                                $update_seats = "update ".config\Flying_date_table::NAME." set ".config\Flying_date_table::ETAKEN." = ".config\Flying_date_table::ETAKEN." - 1".
                                    " where f_date = '$off_date' and f_FID = '$fid';";
                            }
                            else if ($seat_class == 'C') {
                                $update_seats = "update ".config\Flying_date_table::NAME." set ".config\Flying_date_table::CTAKEN." = ".config\Flying_date_table::CTAKEN." - 1".
                                    " where f_date = '$off_date' and f_FID = '$fid';";
                            }
                            else {
                                $update_seats = "update ".config\Flying_date_table::NAME." set ".config\Flying_date_table::FTAKEN." = ".config\Flying_date_table::FTAKEN." - 1".
                                    " where f_date = '$off_date' and f_FID = '$fid';";
                            }
                            $link->query($update_seats, MYSQLI_STORE_RESULT);
                            if ($link->affected_rows > 0) {
                                $reg_cancel = "update ".config\Ticket_table::NAME.
                                    " set ".config\Ticket_table::CANCELED." = true where ".config\Ticket_table::ID." = $tid;";
                                $link->query($reg_cancel, MYSQLI_STORE_RESULT);
//                                echo $reg_cancel . "<br />";
                                if ($link->affected_rows > 0) {
                                    if ((bool)$alpaid == true) {
                                        $refund = "update ".config\User_table::NAME.
                                            " set ".config\User_table::BALANCE." = ".config\User_table::BALANCE.
                                            " + $price where ".config\User_table::ID." = $usr->UID;";
//                                        echo $refund . "<br />";
                                        $link->query($refund, MYSQLI_STORE_RESULT);
                                        if ($link->affected_rows > 0) {
                                            $link->commit();
                                            $succeeded = true;
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            }while($try_times--);
            if ($try_times == 0 && !$succeeded) {
                $link->rollback();
                throw new user_exception(user_exception_codes::ServerBusy);
            }
        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw $ex;
        }
        finally {
            $link->autocommit(true);
        }
    }

    /**
     * look up the history of ticket and order, using join ticket and order to show
     * @param mysqli $link
     * @param flight_User $usr
     * @return array
     * @throws user_exception
     */
    public static function lookup_history(mysqli &$link, flight_User &$usr) {
        try {
            $query = "select ".
                config\Order_table::ID.",".config\Order_table::UID.",".config\Order_table::TIME.",".
                config\Order_table::PAID.",".config\Order_table::COST.",".
                config\Ticket_table::ID.",".config\Ticket_table::CANCELED.",".
                config\Ticket_table::GOT_TIME.",".config\Ticket_table::TOOKOFF_TIME.",".
                config\Ticket_table::FID.",".config\Ticket_table::SEATCLAS.",".config\Ticket_table::PRICE." from ".
                config\Order_table::NAME." join ".config\Ticket_table::NAME." on ".
                config\Order_table::NAME.".".config\Order_table::ID." = ".config\Ticket_table::NAME.".".config\Ticket_table::OID.
                " and ".config\Order_table::UID." = ". $usr->UID.";";

            $result = $link->query($query);
            $ret = array();
            while ($temp = $result->fetch_row()) {$ret[] = $temp;}
//            while(list($oid, $uid, $otime, $opaid, $ocost, $tid, $tcanceled, $tgottime, $tofftime,
//                $fid, $seatclass, $tprice) = $result->fetch_row()) {
//
//            }
            $result->free();
//            var_dump($ret);
            return $ret;
        }
        catch (mysqli_sql_exception $ex) {
            throw $ex;
        }
        catch (user_exception $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw $ex;
        }
        finally {
            $link->autocommit(true);
        }
    }
}
