<?php

Class RentBuy
{
    private $totalInterest;
    private $totalPrincipal;
    private $school;
    private $municipal;
    private $renovations;
    private $condo;
    private $snow;
    private $down;
    private $welcome;
    private $notary;
    private $inflation;
    private $penalty;
    private $appreciation;
    private $rent;
    private $anniversary;
    private $value;
    private $interestRate;
    private $exit;
    private $term;
    private $insurance;
    private $totalInsurance;
    private $totalMunicipal;
    private $totalSchool;
    private $totalRenovatons;
    private $totalCondo;
    private $totalSnow;
    private $totalWelcome;
    private $totalNotary;
    private $totalPenalty;
    private $totalLoss;
    private $totalCashOut;
    private $totalAppreciatedCapital;
    private $profitFromBuying;
    private $totalRent;
    private $diffBuyRent;
    private $pmt;
    private $lastPayment;
    private $recurrentNonMortgage;

    public function __construct($array)
    {
$this->school=array_key_exists('school', $array) ? $array['school'] : null;
        $this->municipal=array_key_exists('municipal', $array) ? $array['municipal'] : null;
        $this->renovations=array_key_exists('renovations', $array) ? $array['renovations'] : null;
        $this->condo=array_key_exists('condo', $array) ? $array['condo'] : null;
$this->snow=array_key_exists('snow', $array) ? $array['snow'] : null;
$this->down=array_key_exists('down', $array) ? $array['down'] : null;
$this->welcome=array_key_exists('welcome', $array) ? $array['welcome'] : null;
$this->notary=array_key_exists('notary', $array) ? $array['notary'] : null;
$this->inflation=array_key_exists('inflation', $array) ? $array['inflation'] : null;
$this->penalty=array_key_exists('penalty', $array) ? $array['penalty'] : null;
$this->appreciation=array_key_exists('appreciation', $array) ? $array['appreciation'] : null;
$this->rent=array_key_exists('rent', $array) ? $array['rent'] : null;
$this->anniversary=array_key_exists('anniversary', $array) ? $array['anniversary'] : null;
$this->value=array_key_exists('value', $array) ? $array['value'] : null;
$this->interestRate=array_key_exists('interestRate', $array) ? $array['interestRate'] : null;
$this->exit=array_key_exists('exit', $array) ? $array['exit'] : null;
$this->insurance=array_key_exists('insurance', $array) ? $array['insurance'] : null;
$this->term=array_key_exists('term', $array) ? $array['term'] : null;

         $this->pmt = $this->getPayment($this->value - $this->down, $this->interestRate / (100 * 26), $this->term * 26);
        $this->totalInsurance = ($this->value - $this->down) * $this->insurance * $this->exit / 100;
        $this->calculateInterestandPrincipal($this->down, $this->exit, $this->interestRate, $this->term, $this->value, $this->anniversary, $this->pmt);
        $this->totalMunicipal = $this->getTotalFromRate($this->value, $this->municipal / 100, $this->inflation / 100, $this->exit);
        $this->totalSchool = $this->getTotalFromRate($this->value, $this->school / 100, $this->inflation / 100, $this->exit);
        $this->totalRenovatons = $this->getTotalFromRate($this->value, $this->renovations / 100, $this->inflation / 100, $this->exit);
        $this->totalCondo = $this->getTotalFromMonthly($this->condo, $this->inflation / 100, $this->exit);
        $this->totalSnow = $this->getTotalFromYearly($this->snow, $this->inflation / 100, $this->exit);
        $this->totalWelcome = $this->value * $this->welcome / 100;
        $this->totalNotary = $this->notary;
        $this->totalPenalty = $this->getPenalty($this->value - $this->down, $this->interestRate / (100 * 26), $this->term * 26, $this->exit * 26, $this->penalty);
        $this->totalLoss = $this->totalInterest + $this->totalMunicipal + $this->totalSchool + $this->totalRenovatons + $this->totalCondo + $this->totalSnow + $this->totalWelcome + $this->totalNotary + $this->totalInsurance + $this->totalPenalty;
        $this->totalCashOut = $this->totalLoss + $this->totalPrincipal;
        $this->totalAppreciatedCapital = $this->totalPrincipal * pow(1 + $this->appreciation / 100, $this->exit);
        $this->profitFromBuying = $this->totalAppreciatedCapital - $this->totalCashOut;
        $this->totalRent = -$this->getTotalFromMonthly($this->rent, $this->inflation / 100, $this->exit);
        $this->diffBuyRent = $this->profitFromBuying - $this->totalRent;
        $this->recurrentNonMortgage = ($this->totalMunicipal + $this->totalSchool + $this->totalRenovatons + $this->totalCondo + $this->totalSnow + $this->totalInsurance) / (12 * $this->exit);
    }

    function calculateInterestandPrincipal($down, $exit, $rate, $term, $value, $anniversary, $pmt)
    {
        require_once 'Classes/PHPExcel/Calculation/Financial.php';
        $objPHPExcel = new PHPExcel_Calculation_Financial();
        $int = 0;
        $princ = $down;
        $outstanding = $value - $down;
        for ($i = 1; $i <= $exit; $i++) {
            for ($j = 1; $j <= 26; $j++) {
                if ($outstanding > 0) {
                    $int = $outstanding * $rate / (100 * 26);
                    $cumint = $cumint + $int;
                    if ($outstanding + $int > $pmt) {
                        $princ = $pmt - $int;
                    } else {
                        $princ = $int + $outstanding;
                    }
                    $cumprinc = $cumprinc + $princ;
                    if ($j == 1) {
                        $cumprinc = $cumprinc + ($value - $down) * $anniversary / 100;
                    }
                    $outstanding = $value - $cumprinc;
                } else {
                    $this->lastPayment = ($i - 1) * 12 + $j - 1;
                    break 2;
                }
            }
        }
        $this->totalInterest = $cumint;
        $this->totalPrincipal = $cumprinc;
    }

    function getInterest($pv, $rate, $nper, $end_period)
    {
        require_once 'Classes/PHPExcel/Calculation/Financial.php';
        $objPHPExcel = new PHPExcel_Calculation_Financial();
        $result = -$objPHPExcel->CUMIPMT($rate, $nper, $pv, 1, $end_period, 0);
        return $result;
    }

    function getPrincipal($pv, $rate, $nper, $end_period)
    {
        require_once 'Classes/PHPExcel/Calculation/Financial.php';
        $objPHPExcel = new PHPExcel_Calculation_Financial();
        $result = -$objPHPExcel->CUMPRINC($rate, $nper, $pv, 1, $end_period, 0);
        return $result;
    }

    function getPenalty($pv, $rate, $nper, $end_period, $penalty)
    {
        require_once 'Classes/PHPExcel/Calculation/Financial.php';
        $objPHPExcel = new PHPExcel_Calculation_Financial();
        $result = -$objPHPExcel->CUMIPMT($rate, $nper, $pv, $end_period + 1, $end_period + $penalty, 0);
        return $result;
    }

    function getPayment($pv, $rate, $nper)
    {
        require_once 'Classes/PHPExcel/Calculation/Financial.php';
        $objPHPExcel = new PHPExcel_Calculation_Financial();
        $result = -$objPHPExcel->PMT($rate, $nper, $pv, 0);
        return $result;
    }

    function getTotalFromRate($value, $rate, $inflation, $exit)
    {
        if ($inflation == 0) {
            return $value * $rate * $exit;
        } else {
            return $value * $rate * (pow(1 + $inflation, $exit) - 1) / $inflation;
        }
    }

    function getTotalFromMonthly($monthly, $inflation, $exit)
    {
        if ($inflation == 0) {
            return $monthly * 12 * $exit;
        } else {
            return $monthly * 12 * (pow(1 + $inflation, $exit) - 1) / $inflation;
        }
    }

    function getTotalFromYearly($yearly, $inflation, $exit)
    {
        if ($inflation == 0) {
            return $yearly * $exit;
        } else {
            return $yearly * (pow(1 + $inflation, $exit) - 1) / $inflation;
        }
    }

    public function getAnniversary()
    {
        return $this->anniversary;
    }

    public function getAppreciation()
    {
        return $this->appreciation;
    }

    public function getCondo()
    {
        return $this->condo;
    }

    public function getDiffBuyRent()
    {
        return $this->diffBuyRent;
    }

    public function getDown()
    {
        return $this->down;
    }

    public function getLastPayment()
    {
        return $this->lastPayment;
    }

    public function getPmt()
    {
        return $this->pmt;
    }

    public function getExit()
    {
        return $this->exit;
    }

    public function getInflation()
    {
        return $this->inflation;
    }

    public function getInsurance()
    {
        return $this->insurance;
    }

    public function getInterestRate()
    {
        return $this->interestRate;
    }

    public function getMunicipal()
    {
        return $this->municipal;
    }

    public function getNotary()
    {
        return $this->notary;
    }

    public function getProfitFromBuying()
    {
        return $this->profitFromBuying;
    }

    public function getRecurrentNonMortgage()
    {
        return $this->recurrentNonMortgage;
    }

    public function getRenovations()
    {
        return $this->renovations;
    }

    public function getRent()
    {
        return $this->rent;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function getSnow()
    {
        return $this->snow;
    }

    public function getTerm()
    {
        return $this->term;
    }

    public function getTotalAppreciatedCapital()
    {
        return $this->totalAppreciatedCapital;
    }

    public function getTotalCashOut()
    {
        return $this->totalCashOut;
    }

    public function getTotalCondo()
    {
        return $this->totalCondo;
    }

    public function getTotalInsurance()
    {
        return $this->totalInsurance;
    }

    public function getTotalInterest()
    {
        return $this->totalInterest;
    }

    public function getTotalLoss()
    {
        return $this->totalLoss;
    }

    public function getTotalMunicipal()
    {
        return $this->totalMunicipal;
    }

    public function getTotalNotary()
    {
        return $this->totalNotary;
    }

    public function getTotalPenalty()
    {
        return $this->totalPenalty;
    }

    public function getTotalPrincipal()
    {
        return $this->totalPrincipal;
    }

    public function getTotalRenovatons()
    {
        return $this->totalRenovatons;
    }

    public function getTotalRent()
    {
        return $this->totalRent;
    }

    public function getTotalSchool()
    {
        return $this->totalSchool;
    }

    public function getTotalSnow()
    {
        return $this->totalSnow;
    }

    public function getTotalWelcome()
    {
        return $this->totalWelcome;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getWelcome()
    {
        return $this->welcome;
    }
}
