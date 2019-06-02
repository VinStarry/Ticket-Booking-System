<?php


class decimal2P {
    /* this class only dealt with money that has 2 point precision
        @example: 180.99
    */
    private const PRECISION = 2;
    private $money;

    /**
     * decimal2P constructor.
     * @param $money the input string
     * PLEASE PAY ATTENTION to the VALIDATION CHECK
     */
    public function __construct(string $money) {
        $int_part = 0;
        $frac_part = 0;
        $flag_int = true;
        for ($i = 0; $i < strlen($money); $i++) {
            if ('0' <= $money[$i] && $money[$i] <= '9') {
                if ($flag_int) {
                    $int_part = $int_part * 10 + ($money[$i] - '0');
                }
                else {
                    $frac_part = $frac_part * 10 + ($money[$i] - '0');
                }
            }
            else if ($money[$i] == '.') {
                if ($i + 3 != strlen($money)) {
                    $this->money = null;
                    return;
                }
                $flag_int = false;
            }
            else {
                $this->money = null;
                return;
            }
        }
        $this->money = $int_part * 100 + $frac_part;
    }

    public function compare(decimal2P $b) {
        return ($this->money - $b->getMoney()) >= 0;
    }

    public function compare_str(string $b) {
        $bm = new decimal2P($b);
        return $this->compare($bm);
    }

    public function plus(decimal2P $b) {
        $this->money += $b->getMoney();
    }

    public function minus(decimal2P $b) {
        $this->money -= $b->getMoney();
    }

    public function multiply(decimal2P $b) {
        $this->money *= (int)($b->getMoney() / 100);
    }

    public function multiply_discount(int $b) {
        $this->money *= ($b / 100);
    }

    public function getMoney() {
        return $this->money;
    }

    /**
     * @return null if the format is wrong | the str of the money
     */
    public function showMoney() {
        if ($this->money == null)
            return null;
        $int_part = (int)($this->money / 100);
        $frac_part = $this->money % 100;
        return ($frac_part == 0) ? $int_part . ".00" : $int_part . "." . $frac_part;
    }

    /**
     * @return string|null Same as showMoney()
     */
    public function __toString() {
        if ($this->money == null)
            return null;
        $int_part = (int)($this->money / 100);
        $frac_part = $this->money % 100;
        return ($frac_part == 0) ? $int_part . ".00" : $int_part . "." . $frac_part;
    }
}