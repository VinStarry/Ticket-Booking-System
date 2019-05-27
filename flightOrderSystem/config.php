<?php
namespace config;
final class DB_info {
    public const SERVER_ADDRESS = "localhost";
    public const DATABASE_USER_NAME = "seller";
    public const DATABASE_USER_PSW = "123456";
    public const DATABASE_NAME = "ticket";
}

final class User_table {
    // User table
    public const NAME = "User_t";
    public const ID = "U_ID";       // primary key
    public const PASSWORD = "U_PASSWORD";
    public const UNAME = "U_NAME";  // user's name
    public const TELEPHONE = "U_TELEPHONE";
}

final class Order_table {
    // Order table
    public const NAME = "Order_t";
    public const ID = "O_ID";       // primary key
    public const UID = "O_UID";     // foreign key from User table
    public const TIME = "O_TIME";
    public const PAID = "O_PAID";
    public const COST = "O_COST";
}

final class Ticket_table {
    // Ticket table
    public const NAME = "Ticket_t";
    public const ID = "T_ID";       // primary key
    public const OID = "T_OID";     // foreign key from Order table
    public const CANCELED = "T_CANCELED";
    public const GOT_TIME = "T_GOTTIME";
    public const FID = "T_FID";     // foreign key from Flight table
    public const SID = "T_SID";     // foreign key from Seat table
}

final class Flight_table {
    // Flight table
    public const NAME = "Flight_t";
    public const ID = "F_ID";       // primary key
    public const TYPE = "F_TYPE";
    public const DEPART_TIME = "F_DEPARTTIME";
    public const DURATION = "F_DURATION";
    public const DEPART_PLACE = "F_DEPARTPLACE";
    public const ARRIVE_PLACE = "F_ARRIVEPLACE";
    public const BEGIN_SERVICE = "F_BEGIN";
    public const END_SERVICE = "F_END";
    public const SEATS_TOTAL = "F_SEATSTOTAL";
    public const SEATS_TAKEN = "F_SEATSTAKEN";  // calculated from Seat table and Order table
}

final class Seat_table {
    // Seat table
    public const NAME = "Seat_t";
    public const ID = "S_ID";       // primary key
    public const SCLASS = "S_CLASS";
    public const PRICE = "S_PRICE";
    public const DISCOUNT = "S_DISCOUNT";
    public const FID = "S_FID";     // foreign key from Flight table
}

?>