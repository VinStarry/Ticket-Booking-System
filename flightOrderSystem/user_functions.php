<?php

/**
 * Class user_exception_codes shows the exception codes for user_exception
 */
class user_exception_codes {
    public const NameTooLong = 1;
    public const PswTooLong = 2;
    public const TelTooLong = 3;
    public const InsertAcconutFailed = 4;
}

class user_exception extends Exception {
    public $code;

    public function __construct($code = 0) {
        $this->code = $code;
        parent::__construct("", $code, null);
    }

    public function __toString() {
        switch ($this->code) {
            case user_exception_codes::NameTooLong:
                return "Name too long.";
            case user_exception_codes::PswTooLong:
                return "Password too long.";
            case user_exception_codes::TelTooLong:
                return "Telephone too long.";
            case user_exception_codes::InsertAcconutFailed:
                return "Insert into user account table falied";
            default:
                return "Some user exception occurred.";
        }
    }
}

final class User_functions {
    /**
     * create an account for user, and insert it into User_table
     * @param mysqli $link:  mysqli connection
     * @param string $name:  user input name
     * @param string $psw:  user input password
     * @param string $tel:  user input telephone
     * @throws user_exception   some exception specified by Code
     */
    const TRY_TIMES = 3;
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
                $try_times = self::TRY_TIMES;
                $succeeded = false;
                do {
                    $link->autocommit(false);
                    $find_max_id_query = "select max(" . config\User_table::ID . ")" .
                        " from " . config\User_table::NAME;
                    $result = $link->query($find_max_id_query);
                    list($maxid) = $result->fetch_row();
                    $id = ($maxid == null) ? 60001 : $maxid + 1;
                    $insert_account = "insert into " . config\User_table::NAME .
                        " values(" . "$id,'$name','$psw','$tel'" . ");";
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
                    $try_times--;
                }while($try_times != 0);
                if ($succeeded == false) {
                    // Already tried 3 times but still failed
                    throw new user_exception(user_exception_codes::InsertAcconutFailed);
                }
            }
            catch (mysqli_sql_exception $ex) {
                echo $ex->getMessage();
                throw $ex;
            }
        }
    }

//    public static function login_account(mysqli &$link, )

}
