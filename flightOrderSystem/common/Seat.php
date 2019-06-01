<?php

class Seat {
    private $sid;
    private $sclass;
    private $sprice;
    private $sdiscount;
    private $s_fid;

    public function __construct($seat_id, $seat_class, $seat_price, $seat_discount, $seat_fid) {
        $this->sid = $seat_id;
        $this->sclass = $seat_class;
        $this->sprice = $seat_price;
        $this->sdiscount = $seat_discount;
        $this->s_fid = $seat_fid;
    }

    public function __toString() {
        return $this->sid . "," . $this->sclass . "," .
            $this->sprice . "," . $this->sdiscount . "," . $this->s_fid;
    }
}