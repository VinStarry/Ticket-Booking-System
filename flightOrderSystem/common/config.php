<?php
namespace config;

final class DB_info {
    public const SERVER_ADDRESS = "127.0.0.1";
    public const DATABASE_USER_NAME = "seller";
    public const DATABASE_USER_PSW = "123456";
    public const DATABASE_NAME = "ticket";
}

final class Code_CITY {
    // Code to Address and City
    public const NAME = "code_addr";
    public const CODE = "AP_CODE";          // primary key, @datatype: char(3)
    public const AP_NAME = "AP_NAME";       // @datatype: char(50)
    public const CITY = "AP_CITY";          // @datatype: char(20)
}

final class User_table {
    // User table
    public const NAME = "User_t";
    public const ID = "U_ID";               // primary key, @datatype: int
    public const PASSWORD = "U_PASSWORD";   // @datatype: char(30)
    public const UNAME = "U_NAME";          // @datatype: char(30)
    public const TELEPHONE = "U_TELEPHONE"; // @datatype: char(20)
    public const BALANCE = "U_BALANCE";     // @datatype: decimal(8,2)
}

final class Order_table {
    // Order table
    public const NAME = "Order_t";
    public const ID = "O_ID";       // primary key, @datatype: char(30)
    public const UID = "O_UID";     // foreign key from User table
                                    // @datatype: int
    public const TIME = "O_TIME";   // @datatype: datetime
    public const PAID = "O_PAID";   // @datatype: boolean
    public const COST = "O_COST";   // @datatype: decimal(8,2)
}

final class Flight_table {
    // Flight table
    public const NAME = "Flight_t";
    public const ID = "F_ID";                   // primary key, @datatype: int
    public const TYPE = "F_TYPE";               // @datatype: char(10)
    public const DEPART_TIME = "F_DEPARTTIME";  // @datatype: time
    public const DURATION = "F_DURATION";       // @datatype: int
    public const DEPART_PLACE = "F_DEPARTPLACE";// @datatype: char(3)
    public const ARRIVE_PLACE = "F_ARRIVEPLACE";// @datatype: char(3)
    public const BEGIN_SERVICE = "BEGIN_SERVICE";     // @datatype: datetime
    public const END_SERVICE = "END_SERVICE";         // @datatype: datetime
    public const FSEAT_NUMBER = "FSEAT_NUMBER";       // @datatype: int
    public const CSEAT_NUMBER = "CSEAT_NUMBER";       // @datatype: int
    public const ESEAT_NUMBER = "CSEAT_NUMBER";       // @datatype: int
}

final class Ticket_table {
    // Ticket table
    public const NAME = "Ticket_t";
    public const ID = "T_ID";                   // primary key @datatype: int
    public const OID = "T_OID";                 // foreign key from Order table
                                                // @datatype: int
    public const CANCELED = "T_CANCELED";       // @datatype: boolean
    public const TOOKOFF_TIME = "T_TOKEOFFTIME";// @datatype: datetime
    public const GOT_TIME = "T_GOTTIME";        // @datatype: datetime
    public const FID = "T_FID";                 // foreign key from Flight table
                                                // @datatype: int
    public const SID = "T_SID";                 // foreign key from Seat table
                                                // @datatype: int
}

final class Flying_date_table {
    // Flying date table
    public const NAME = "Flying_date";
    public const FDATE = "f_date";              // @datatype: date, part of priamry key
    public const FID = "f_FID";                 // @datatype: int, part of priamry key
    public const EDISCONUT = "f_ediscount";     // @datatype: int
    public const CDISCOUNT = "f_cdiscount";     // @datatype: int
    public const FDISCOUNT = "f_fdiscount";     // @datatype: int
    public const EPRICE = "e_price";            // @datatype: decimal(8,2)
    public const CPRICE = "c_price";            // @datatype: decimal(8,2)
    public const FPRICE = "f_price";            // @datatype: decimal(8,2)
    public const ETAKEN = "e_taken";            // @datatype: int , default 0
    public const CTAKEN = "c_taken";            // @datatype: int , default 0
    public const FTAKEN = "f_taken";            // @datatype: int , default 0
    public const REVENUE = "revenue";           // @datatype: decimal(11, 2) , default 0.00
}

?>