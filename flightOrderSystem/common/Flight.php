<?php


class Flight {
    private $fid;
    private $f_type;
    private $depart_time;
    private $duration;
    private $depart_place;
    private $arrive_place;
    private $begin_service_date;
    private $end_service_date;
    private $f_number;
    private $e_number;
    private $c_number;

    public function __construct($fid, $f_type, $depart_time,
                                $duration, $depart_place, $arrive_place,
                                $begin_service_date, $end_service_date,
                                $f_number, $e_number, $c_number) {
        $this->fid = $fid;
        $this->f_type = $f_type;
        $this->depart_time = $depart_time;
        $this->duration = $duration;
        $this->depart_place = $depart_place;
        $this->arrive_place = $arrive_place;
        $this->begin_service_date = $begin_service_date;
        $this->end_service_date = $end_service_date;
        $this->f_number = $f_number;
        $this->e_number = $e_number;
        $this->c_number = $c_number;
    }

    public function __toString() {
        return $this->fid . ",'" . $this->f_type . "','" .  $this->depart_time . "'," .  $this->duration . ",'" .
            $this->depart_place . "','" .  $this->arrive_place . "','" .  $this->begin_service_date . "','" .  $this->end_service_date . "'," .
            $this->f_number . "," . $this->e_number . "," . $this->c_number;
    }
}

